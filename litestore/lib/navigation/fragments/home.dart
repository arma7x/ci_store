import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:litestore/api.dart';
import 'package:litestore/config.dart';
import 'package:litestore/widgets/category.dart';
import 'package:litestore/widgets/product.dart';

class Home extends StatefulWidget {

  Home({Key key}) : super(key: key);

  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> {

  List<Widget> _categoryList = [];
  bool _categoryLoaded = false;
  bool _categoryLoading = true;
  List<Widget> _productList = [];
  bool _productLoaded = false;
  bool _error = false;
  bool _ignoring = false;

  _HomeState() {
    _getCategory();
    _getProduct();
  }

  void _getCategory() async {
    List<Widget> tempList = List();
    try {
      final request = await Api.getProductCategory();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        for (var item in json.decode(responseBody)) {
          tempList.add(Category.fromJson(item, null));
        }
        setState(() {
          _categoryList = tempList;
          _categoryLoaded = true;
          _categoryLoading = false;
        });
      } else {
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
        setState(() {
          _categoryLoaded = false;
          _categoryLoading = false;
        });
      }
    } on Exception {
      setState(() {
        _categoryLoaded = false;
        _categoryLoading = false;
      });
    }
  }

  void _getProduct() async {
    List<Widget> tempList = List();
    try {
      final request = await Api.getProductSpotlight();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        for (var item in json.decode(responseBody)) {
          tempList.add(Product.fromJson(item, _ignoringCb));
        }
        setState(() {
          _productLoaded = true;
          _productList = tempList;
          _error = false;
        });
      } else {
        setState(() => _error = true);
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
      }
    } on Exception {
      setState(() => _error = true);
      Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
    }
  }

  void _ignoringCb(bool status) {
    setState(() => _ignoring = status);
  }

  @override
  Widget build(BuildContext context) {

    if (this._error == true) {
      return new Center(
        child: Container(
          width: 160,
          child: RaisedButton(
            padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 0.0),
            onPressed: () {
              setState(() {
                _error = false;
                _productLoaded = false;
              });
              _getCategory();
              _getProduct();
            },
            child: Row(
              children: <Widget>[
                Icon(Icons.signal_wifi_off, size: 25, color: Config.THEME_COLOR),
                SizedBox(width: 10),
                Text("CUBA LAGI"),
              ]
            )
          ),
        )
      );
    }

    if (this._productLoaded == false) {
      return new Center(
        child: new CircularProgressIndicator(),
      );
    }

    return new Container(
      child: IgnorePointer(
        ignoring: this._ignoring,
        child: new Column(
          children: <Widget>[
            this._ignoring ? new LinearProgressIndicator() : SizedBox(height: 0, width: 0),
            this._categoryLoaded == true ? new Container(
              height: 65.0,
              child: new ListView(
                scrollDirection: Axis.horizontal,
                padding: EdgeInsets.fromLTRB(5.0, 0.0, 5.0, 0.0),
                children: this._categoryList
              )
            ) : new Center(
              child: this._categoryLoading == false ? Container(
                width: 160,
                child: RaisedButton(
                  padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 0.0),
                  onPressed: () {
                    setState(() => _categoryLoading = true);
                    _getCategory();
                  },
                  child: Row(
                    children: <Widget>[
                      Icon(Icons.signal_wifi_off, size: 25, color: Config.THEME_COLOR),
                      SizedBox(width: 10),
                      Text("CUBA LAGI"),
                    ]
                  )
                ),
              ) : new LinearProgressIndicator()
            ),
            new Expanded(
              child: new ListView(
                scrollDirection: Axis.vertical,
                children: this._productList
              )
            ),
          ]
        )
      )
    );
  }
}

