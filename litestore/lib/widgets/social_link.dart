import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:litestore/config.dart';

class SocialLink extends StatelessWidget {

  final String id;
  final String name;
  final String icon;
  final String url;

  SocialLink._({Key key, this.id, this.name, this.icon, this.url});

  factory SocialLink.fromJson(Map<String, dynamic> json) {
    return new SocialLink._(
      id: json['id'],
      name: json['name'],
      icon: json['icon'],
      url: json['url'],
    );
  }

  void _openApp(String url) async {
    if (await canLaunch(url)) {
      await launch(url);
    } else {
      print ('Could not launch $url');
    }
  }

  @override
  Widget build(BuildContext context) {

    return new GestureDetector(
      child: new Container(
        child: new Row(
          children: [
            new Container(
              height: 38,
              width: 38,
              child: ClipOval(
                child: Image.memory(
                  base64Decode(this.icon.split(",")[1]),
                  width: 38,
                  height: 38,
                  fit: BoxFit.cover,
                ),
              ),
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.white,
                boxShadow: [
                  BoxShadow(
                      color: Colors.grey,
                      blurRadius: 5.0,
                      offset: Offset(1.5, 1.5),
                      spreadRadius: 1.5)
                ],
              ),
            ),
            this.name != '' ? SizedBox(width: 5) : SizedBox(width: 0),
            this.name != '' ? Expanded(
              child: new Text(
                this.name.toUpperCase(),
                style: TextStyle(color: Config.THEME_COLOR, fontSize: 12)
              )
            ) : SizedBox(width: 0)
          ]
        ),
      ),
      onTap: () {
        _openApp(this.url);
      },
    );
  }
}
