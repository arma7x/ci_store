import 'package:flutter/material.dart';
import 'package:litestore/api.dart';
import 'package:litestore/widgets/category.dart';
import 'package:litestore/widgets/product.dart';
import 'dart:convert';

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

  _HomeState() {
    getCategory();
    getProduct();
  }

  void getCategory() async {
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

  void getProduct() async {
    List<Widget> tempList = List();
    try {
      final request = await Api.getProductSpotlight();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        for (var item in json.decode(responseBody)) {
          tempList.add(Product.fromJson(item));
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
              getCategory();
              getProduct();
            },
            child: Row(
              children: <Widget>[
                Icon(Icons.signal_wifi_off, size: 25, color: Colors.blue),
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
      child: new Column(
        children: <Widget>[
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
    );
  }
}

