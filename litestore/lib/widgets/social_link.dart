import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'dart:convert';
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
        margin: const EdgeInsets.fromLTRB(0.0, 3, 0.0, 3),
        child: new Row(
          children: [
            ClipOval(
              child: Image.memory(
                base64Decode(this.icon.split(",")[1]),
                width: 38,
                height: 38,
                fit: BoxFit.cover,
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
      onLongPress: () {
        print(this.name);
      },
    );
  }
}
