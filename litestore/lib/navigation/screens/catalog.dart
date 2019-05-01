import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:litestore/widgets/product.dart';
import 'package:litestore/widgets/category.dart';
import 'package:litestore/api.dart';
import 'package:litestore/config.dart';

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
  String _initValueSpotlight = '';
  String _initValueSpotlightName = 'Papar Semua';
  final List<dynamic> _spotlightFilter = [{'id': '', 'name': 'Papar Semua'}, {'id': '0', 'name': 'Bukan Spotlight'}, {'id': '1', 'name': 'Spotlight Sahaja'}];
  String _initValueOrder = '';
  String _initValueOrderName = 'Keluaran Terbaru';
  final List<dynamic> _orderFilter = [{'id': 'created_at@desc', 'name': 'Keluaran Terbaru'}, {'id': 'created_at@asc', 'name': 'Keluaran Terdahulu'}, {'id': 'price@desc', 'name': 'Mahal(Harga)'}, {'id': 'price@asc', 'name': 'Berpatutan(Harga)'}];
  String _initValueCategory = '';
  String _initValueCategoryName = 'Pelbagai Kategori';
  List<dynamic> _categoryFilter = [{'id': '', 'name': 'Pelbagai Kategori'}];
  List<Widget> _categoryList = [];
  bool _categoryLoaded = false;
  List<Widget> _productList = [];
  bool _productLoaded = false;
  bool _error = false;
  bool _ignoring = false;
  bool _nextPageLoading = false;
  Map<String, String> _query = {'keyword': '', 'ordering': '', 'spotlight': '', 'category': '', 'page': ''};
  Widget appBarTitle = new Text('Katalog');
  Icon actionIcon = new Icon(Icons.search);

  _CatalogPageState(String category, String name) {
    this._query['category'] = category;
    this._initValueCategory = category;
    this._initValueCategoryName = name;
    _getCategory();
    _searchProduct();
  }

  void _ignoringCb(bool status) {
    setState(() => _ignoring = status);
  }

  void _getCategory() async {
    List<dynamic> tempList = [];
    List<Widget> tempListTop = [];
    try {
      final request = await Api.getProductCategory();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        tempList..add(this._categoryFilter[0])
                ..addAll(json.decode(responseBody));
        for (var item in json.decode(responseBody)) {
          tempListTop.add(Category.fromJson(item, _categoryCallback));
        }
        setState(() {
          _categoryList = tempListTop;
          _categoryFilter = tempList;
          _categoryLoaded = true;
        });
      } else {
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
      }
    } on Exception {
      Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
    }
  }

  void _categoryCallback(id, name) {
    Map<String, String> query = this._query;
    query['category'] = id;
    setState(() {
      _initValueCategory = id;
      _initValueCategoryName = name;
      _query = query;
      _productLoaded = false;
    });
    this._searchProduct();
  }

  void _searchProduct() async {
    Map<String, dynamic> _tempSearchResult = {};
    List<Widget> tempList = List();
    this._query['page'] = '1';
    try {
      final request = await Api.searchProduct(this._query);
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        _tempSearchResult = json.decode(responseBody);
        for (var item in _tempSearchResult['result']) {
          tempList.add(Product.fromJson(item, _ignoringCb));
        }
        setState(() {
          _productLoaded = true;
          _searchResult = _tempSearchResult;
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

  void _nextProduct() async {
    Map<String, dynamic> _tempSearchResult = {};
    List<Widget> tempList = List();
    Map<String, String> query = this._query;
    query['page'] = this._searchResult['next_page'].toString();
    setState(() {
      _query = query;
      _nextPageLoading = true;
    });
    try {
      final request = await Api.searchProduct(this._query);
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        _tempSearchResult = json.decode(responseBody);
        for (var item in _tempSearchResult['result']) {
          tempList.add(Product.fromJson(item, _ignoringCb));
        }
        setState(() {
          _searchResult = _tempSearchResult;
          _productList = List.from(_productList)..addAll(tempList);
          _nextPageLoading = false;
        });
      } else {
        setState(() => _nextPageLoading = false);
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
      }
    } on Exception {
      setState(() => _nextPageLoading = false);
      Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_LONG);
    }
  }

   Widget _categoryPopup() {
     return PopupMenuButton(
      initialValue: this._initValueCategory,
      onSelected: _onSelectCategory,
      child: new Container(
        child: new Row(
          children: <Widget>[
            new Expanded(child: Text(this._initValueCategoryName)),
            new Icon(Icons.arrow_drop_down, color: Colors.grey),
          ]
        ),
        height: 40.0,
      ),
      itemBuilder: (context) {
        List<PopupMenuItem> items = List();
        for (var item in this._categoryFilter) {
          items.add(PopupMenuItem(value: item['id'], child: Text(item['name'])));
        }
        return items;
      }
    );
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
    query['category'] = value;
    setState(() {
      _initValueCategory = value;
      _initValueCategoryName = initValueCategoryName;
      _query = query;
    });
    Navigator.pop(context);
    _showSearchFilter();
  }

   Widget _spotlightPopup() {
     return PopupMenuButton(
      initialValue: this._initValueSpotlight,
      onSelected: _onSelectSpotlight,
      child: new Container(
        child: new Row(
          children: <Widget>[
            new Expanded(child: Text(this._initValueSpotlightName)),
            new Icon(Icons.arrow_drop_down, color: Colors.grey),
          ]
        ),
        height: 40.0,
      ),
      itemBuilder: (context) {
        List<PopupMenuItem> items = List();
        for (var item in this._spotlightFilter) {
          items.add(PopupMenuItem(value: item['id'], child: Text(item['name'])));
        }
        return items;
      }
    );
  }

  void _onSelectSpotlight(dynamic value) {
    Map<String, String> query = this._query;
    String initValueSpotlightName = 'Papar Semua';
    for(var item in this._spotlightFilter) {
      if (item['id'] == value) {
        initValueSpotlightName = item['name'];
        break;
      }
    }
    query['spotlight'] = value;
    setState(() {
      _initValueSpotlight = value;
      _initValueSpotlightName = initValueSpotlightName;
      _query = query;
    });
    Navigator.pop(context);
    _showSearchFilter();
  }

   Widget _orderPopup() {
     return PopupMenuButton(
      initialValue: this._initValueSpotlight,
      onSelected: _onSelectOrder,
      child: new Container(
        child: new Row(
          children: <Widget>[
            new Expanded(child: Text(this._initValueOrderName)),
            new Icon(Icons.arrow_drop_down, color: Colors.grey),
          ]
        ),
        height: 40.0,
      ),
      itemBuilder: (context) {
        List<PopupMenuItem> items = List();
        for (var item in this._orderFilter) {
          items.add(PopupMenuItem(value: item['id'], child: Text(item['name'])));
        }
        return items;
      }
    );
  }

  void _onSelectOrder(dynamic value) {
    Map<String, String> query = this._query;
    String initValueOrderName = 'Papar Semua';
    for(var item in this._orderFilter) {
      if (item['id'] == value) {
        initValueOrderName = item['name'];
        break;
      }
    }
    query['ordering'] = value;
    setState(() {
      _initValueOrder = value;
      _initValueOrderName = initValueOrderName;
      _query = query;
    });
    Navigator.pop(context);
    _showSearchFilter();
  }
  
  void _showSearchFilter() {
    showModalBottomSheet<void>(context: context, builder: (BuildContext context) {
      return Container(
        height: 250,
        child: Padding(
          padding: const EdgeInsets.all(30.0),
          child: Column(
            children: <Widget>[
              Text('Tapis Carian', style: TextStyle(color: Colors.black, fontSize: 18)),
              Row(
                children: <Widget>[
                  Text('Kategori: ', style: TextStyle(color: Colors.grey)),
                  SizedBox(width: 10),
                  new Expanded(child: _categoryPopup()),
                ]
              ),
              Row(
                children: <Widget>[
                  Text('Spotlight: ', style: TextStyle(color: Colors.grey)),
                  SizedBox(width: 10),
                  new Expanded(child: _spotlightPopup()),
                ]
              ),
              Row(
                children: <Widget>[
                  Text('Susunan: ', style: TextStyle(color: Colors.grey)),
                  SizedBox(width: 10),
                  new Expanded(child: _orderPopup()),
                ]
              ),
              RaisedButton(
                padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 0.0),
                onPressed: () {
                  setState(() => _productLoaded = false);
                  _searchProduct();
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

    List<Widget> _productList = [];
    _productList.addAll(this._productList);
    if (this._nextPageLoading) {
      _productList..add(SizedBox(height: 10))
                  ..add(new Center(
                      child: new CircularProgressIndicator()
                  ))
                  ..add(SizedBox(height: 10));
    }
    if (this._searchResult['next_page'] != null && this._nextPageLoading == false) {
      _productList.add(FlatButton(
        padding: EdgeInsets.fromLTRB(30.0, 0.0, 30.0, 0.0),
        onPressed: _nextProduct,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Text('Halaman Berikut', style: TextStyle(color: Config.THEME_COLOR)),
          ]
        )
      ));
    }

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
              _searchProduct();
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
    } else if (this._productLoaded == false) {
      body = new Center(
        child: new CircularProgressIndicator(),
      );
    } else if(_productList.length == 0) {
      body = new Center(
        child: new Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Icon(Icons.sentiment_neutral, size: 60, color: Config.THEME_COLOR),
            SizedBox(height: 5),
            Text("CARIAN TIDAK DIJUMPAI"),
          ]
        )
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
                  children: _productList
                )
              ),
            ]
          )
        )
      );
    }
    return Scaffold(
      appBar: AppBar(
        title: this.appBarTitle,
        actions: <Widget>[
          new IconButton(
            icon: this.actionIcon,
            onPressed: () {
              setState(() {
                if ( this.actionIcon.icon == Icons.search){
                  this.actionIcon = new Icon(Icons.close);
                  this.appBarTitle = new TextField(
                    cursorColor: Colors.white,
                    keyboardType: TextInputType.text,
                    textInputAction: TextInputAction.search,
                    onSubmitted: (String text) {
                      _productLoaded = false;
                      _searchProduct();
                    },
                    onChanged: (String text) {
                      Map<String, String> query = this._query;
                      query['keyword'] = text;
                      _query = query;
                    },
                    autofocus: true,
                    style: new TextStyle(color: Colors.white),
                    decoration: new InputDecoration(
                      hintText: "Carian...",
                      border: InputBorder.none,
                      hintStyle: new TextStyle(color: Colors.white)
                    ),
                  );
                } else {
                  this.actionIcon = new Icon(Icons.search);
                  this.appBarTitle = new Text(widget.title);
                  Map<String, String> query = this._query;
                  query['keyword'] = '';
                  _query = query;
                }
              });
            }
          ),
          IconButton(
            icon: Icon(Icons.tune),
            onPressed: _showSearchFilter,
          ),
        ],
      ),
      body: new Container(
        child: new Column(
          children: <Widget>[
            new Container(
              height: 65.0,
              child: new ListView(
                scrollDirection: Axis.horizontal,
                padding: EdgeInsets.fromLTRB(5.0, 0.0, 5.0, 0.0),
                children: this._categoryList
              )
            ),
            new Expanded(child: body)
          ]
        )
      )
    );
  }
}
