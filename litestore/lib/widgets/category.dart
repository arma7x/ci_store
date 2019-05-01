import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart' show CupertinoPageRoute;
import 'package:fluttertoast/fluttertoast.dart';
import 'package:litestore/navigation/screens.dart';
import 'package:litestore/config.dart';

class Category extends StatelessWidget {

  final String id;
  final String name;
  final String icon;
  final Function callback;

  Category._({Key key, this.id, this.name, this.icon, this.callback});

  factory Category.fromJson(Map<String, dynamic> json, cb) {
    return new Category._(
      id: json['id'],
      name: json['name'],
      icon: json['icon'],
      callback: cb,
    );
  }

  @override
  Widget build(BuildContext context) {

    return new Container(
      child: new Material(
        child: new InkWell(
          onLongPress: () {
            Fluttertoast.showToast(msg: this.name, toastLength: Toast.LENGTH_SHORT);
          },
          onTap: () {
            if (this.callback != null) {
              callback(this.id, this.name);
            } else {
              Navigator.push(
                context,
                CupertinoPageRoute(builder: (BuildContext context) => new CatalogPage(title: 'Katalog', category: this.id, name: this.name))
              );
            }
          },
          child: new Container(
            margin: const EdgeInsets.fromLTRB(10.0, 10.0, 10.0, 5.0),
            child: new Column(
              children: [
                Image.memory(
                  base64Decode(this.icon.split(",")[1]),
                  width: 30,
                  height: 30 
                ),
                SizedBox(height: 5),
                new Text(
                  this.name.toUpperCase(),
                  style: TextStyle(color: Config.THEME_COLOR, fontSize: 12)
                )
              ]
            ),
          ),
        ),
        color: Colors.transparent,
      ),
      color: Colors.transparent,
    );
  }
}
