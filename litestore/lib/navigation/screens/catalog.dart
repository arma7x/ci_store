import 'package:flutter/material.dart';
import 'package:litestore/widgets/category.dart';
import 'package:litestore/widgets/product.dart';
import 'package:litestore/api.dart';
import 'dart:convert';


//class Catalog extends StatelessWidget {

  //@override
  //Widget build(BuildContext context) {
    //return new CatalogPage(title: 'Catalog');
  //}

//}

class CatalogPage extends StatefulWidget {
  CatalogPage({Key key, this.title, this.category, this.name}) : super(key: key);

  final String title;
  final String category;
  final String name;

  @override
  _CatalogPageState createState() => _CatalogPageState(category, name);
}

class _CatalogPageState extends State<CatalogPage> {

  Map<String, dynamic> _searchResult = {};
  final List<dynamic> _spotlightFilter = [
    {'id': '', 'name': 'Papar Semua'},
    {'id': '0', 'name': 'Bukan Spotlight'},
    {'id': '1', 'name': 'Spotlight Sahaja'},
  ];
  final List<dynamic> _orderFilter = [
    {'id': 'created_at@desc', 'name': 'Keluaran Terbaru'},
    {'id': 'created_at@asc', 'name': 'Keluaran Terdahulu'},
    {'id': 'price@desc', 'name': 'Mahal(Harga)'},
    {'id': 'price@asc', 'name': 'Berpatutan(Harga)'},
  ];
  String _initValueCategory = '';
  String _initValueCategoryName = 'Pelbagai Kategori';
  List<dynamic> _categoryFilter = [{'id': '', 'name': 'Pelbagai Kategori'}];
  bool _categoryLoaded = false;
  List<Widget> _productList = [];
  bool _productLoaded = false;
  bool _error = false;
  bool _ignoring = false;
  Map<String, String> _query = {'keyword': '', 'ordering': '', 'spotlight': '', 'category': '', 'page': ''};

  _CatalogPageState(String category, String name) {
    this._query['category'] = category;
    this._initValueCategory = category;
    this._initValueCategoryName = name;
    getCategory();
    getProduct();
  }

  void cb(bool status) {
    setState(() => _ignoring = status);
  }

  void getCategory() async {
    List<dynamic> tempList = [];
    try {
      final request = await Api.getProductCategory();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        tempList.add(this._categoryFilter[0]);
        tempList.addAll(json.decode(responseBody));
        setState(() {
          _categoryLoaded = true;
          _categoryFilter = tempList;
        });
      } else {
        print('Failed to category');
      }
    } on Exception {
      print('Catch Failed to category');
    }
  }

  void getProduct() async {
    Map<String, dynamic> _tempSearchResult = {};
    List<Widget> tempList = List();
    try {
      final request = await Api.searchProduct(this._query);
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        _tempSearchResult = json.decode(responseBody);
        for (var item in _tempSearchResult['result']) {
          tempList.add(Product.fromJson(item, cb));
        }
        setState(() {
          _productLoaded = true;
          _searchResult = _tempSearchResult;
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

  void _onSelectCategory(dynamic value) {
    Map<String, String> query = this._query;
    String initValueCategoryName = 'Pelbagai Kategori';
    for(var item in this._categoryFilter) {
      if (item['id'] == value) {
        initValueCategoryName = item['name'];
        break;
      }
    }
    this._query['category'] = value;
    setState(() {
      _initValueCategory = value;
      _initValueCategoryName = initValueCategoryName;
      _query = query;
    });
    Navigator.pop(context);
    _showSearchFilter();
  }

   Widget _CategoryPopup() {
     return PopupMenuButton(
      initialValue: this._initValueCategory,
      onSelected: _onSelectCategory,
      child: new Container(child: new Row(
        children: <Widget>[
          new Expanded(child: Text(this._initValueCategoryName)),
          new Icon(Icons.arrow_drop_down),
        ]
      ), height: 65.0,),
      itemBuilder: (context) {
        List<PopupMenuItem> items = List();
        for (var item in this._categoryFilter) {
          items.add(PopupMenuItem(value: item['id'], child: Text(item['name'])));
        }
        return items;
      }
    );
  }
  
  void _showSearchFilter() {
    showModalBottomSheet<void>(context: context, builder: (BuildContext context) {
      return Container(
        child: Padding(
          padding: const EdgeInsets.all(30.0),
          child: Column(
            children: <Widget>[
              Text('Tapis Carian', style: TextStyle(color: Colors.black, fontSize: 18)),
              Row(
                children: <Widget>[
                  Text('Kategori: ', style: TextStyle(color: Colors.grey)),
                  SizedBox(width: 10),
                  //Text(this._initValueCategoryName),
                  SizedBox(width: 5),
                  new Expanded(child: _CategoryPopup()),
                ]
              ),
              RaisedButton(
                padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 0.0),
                onPressed: () {
                  setState(() => _productLoaded = false);
                  getProduct();
                  Navigator.pop(context);
                },
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Text("CARI SEMULA"),
                  ]
                )
              ),
            ]
          )
        ),
      );
    });
  }

  @override
  Widget build(BuildContext context) {

    Widget body;

    if (this._error == true) {
      body = new Center(
        child: Container(
          width: 160,
          child: RaisedButton(
            padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 0.0),
            onPressed: () {
              setState(() {
                _error = false;
                _productLoaded = false;
              });
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
    } else if (this._productLoaded == false) {
      body = new Center(
        child: new CircularProgressIndicator(),
      );
    } else {
      body = new Container(
        child: IgnorePointer(
          ignoring: this._ignoring,
          child: new Column(
            children: <Widget>[
              this._ignoring ? new LinearProgressIndicator() : SizedBox(height: 0, width: 0),
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

    return Scaffold(
      appBar: AppBar(
        title: Text(widget.title),
          actions: <Widget>[
            IconButton(
              icon: Icon(Icons.tune),
              onPressed: _showSearchFilter,
            ),
          ],
      ),
      body: body,
    );
  }
}
