import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart' show CupertinoPageRoute;
import 'package:litestore/navigation/screens.dart';
import 'package:litestore/config.dart';

class Category extends StatelessWidget {

  final String id;
  final String name;
  final String icon;

  Category._({Key key, this.id, this.name, this.icon});

  factory Category.fromJson(Map<String, dynamic> json) {
    return new Category._(
      id: json['id'],
      name: json['name'],
      icon: json['icon'],
    );
  }

  @override
  Widget build(BuildContext context) {
    return new GestureDetector(
      child: new Container(
        margin: const EdgeInsets.fromLTRB(10.0, 5.0, 10.0, 5.0),
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
      onTap: () {
        Navigator.push(
          context,
          CupertinoPageRoute(builder: (BuildContext context) => new CatalogPage(title: 'Katalog', category: this.id, name: this.name))
        );
      },
      onLongPress: () {
        print(this.name);
      },
    );
  }
}
