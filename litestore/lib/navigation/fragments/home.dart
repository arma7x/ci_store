import 'package:flutter/material.dart';
import 'package:litestore/api.dart';
import 'package:litestore/widgets/category.dart';
import 'package:litestore/widgets/product.dart';
import 'dart:convert';
import 'package:litestore/config.dart';

class Home extends StatefulWidget {

  Home({Key key}) : super(key: key);

  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> {

  List<Widget> _categoryList = [];
  bool _categoryLoaded = false;
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
    final request = await Api.getProductCategory();
    final response = await request.close(); 
    if (response.statusCode == 200) {
      final responseBody = await response.transform(utf8.decoder).join();
      for (var item in json.decode(responseBody)) {
        tempList.add(Category.fromJson(item));
      }
      setState(() {
        _categoryLoaded = true;
        _categoryList = tempList;
      });
    } else {
      print('Failed to category');
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
          tempList.add(Product.fromJson(item, cb));
        }
        setState(() {
          _productLoaded = true;
          _productList = tempList;
          _error = false;
        });
      } else {
        setState(() => _error = true);
        print('Failed to product');
      }
    } on Exception {
      setState(() => _error = true);
    }
  }

  void cb(bool status) {
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
                padding: EdgeInsets.fromLTRB(5.0, 5.0, 5.0, 0.0),
                children: this._categoryList
              )
            ) : SizedBox(height: 0, width: 0),
            new Expanded(
              child: new ListView(
                scrollDirection: Axis.vertical,
                //padding: EdgeInsets.fromLTRB(10.0, 10.0, 10.0, 0.0),
                children: this._productList
              )
            ),
          ]
        )
      )
    );
  }
}

