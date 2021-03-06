import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart' show CupertinoPageRoute;
import 'package:fluttertoast/fluttertoast.dart';
import 'package:litestore/navigation/screens.dart';
import 'package:litestore/api.dart';

class InfoButton extends StatelessWidget {

  final String title;
  final String slug;
  final String position;
  final String materialIcon;
  final Function callback;

  InfoButton._({Key key, this.title, this.slug, this.position, this.materialIcon, this.callback});

  factory InfoButton.fromJson(Map<String, dynamic> json, Function cb) {
    return new InfoButton._(
      title: json['title'],
      slug: json['slug'],
      position: json['position'],
      materialIcon: json['material_icon'],
      callback: cb
    );
  }

  @override
  Widget build(BuildContext context) {

    void _viewEi(String slug) async {
      callback(true);
      Map<String, dynamic> tempData = {};
      try {
        final request = await Api.viewEssentialInformation(slug);
        final response = await request.close(); 
        if (response.statusCode == 200) {
          callback(false);
          final responseBody = await response.cast<List<int>>().transform(utf8.decoder).join();
          tempData = json.decode(responseBody);
          Navigator.push(
            context,
            CupertinoPageRoute(builder: (BuildContext context) => ViewEssentialInformation.fromJson(tempData))
          );
        } else {
          Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_SHORT);
          callback(false);
        }
      } catch (exception) {
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_SHORT);
        callback(false);
      }
    }

    int icon;
    try {
      icon = int.parse(this.materialIcon.replaceAll("&#", '0').replaceAll(";", ''));
    } catch (exception) {
      icon = 0xe14b;
    }

    return new Container(
      margin: const EdgeInsets.fromLTRB(0.0, 5.0, 0.0, 5.0),
      child: new Row(
        children: <Widget>[
          new FloatingActionButton(
            heroTag: this.title,
            onPressed: () {
              _viewEi(this.slug);
            },
            mini: true,
            child: Icon(IconData(icon, fontFamily: 'MaterialIcons'), size: 20, color: Colors.white),
          ),
          SizedBox(width: 5),
          Expanded(
            child: new GestureDetector(
              child: new Text(
                this.title.toUpperCase(),
                style: TextStyle(fontSize: 14)
              ),
              onTap: () {
                _viewEi(this.slug);
              }
            )
          )
        ]
      ),
    );
  }
}
