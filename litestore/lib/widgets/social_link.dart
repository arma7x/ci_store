import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'dart:convert';

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
        margin: const EdgeInsets.fromLTRB(0.0, 5.0, 0.0, 5.0),
        child: new Row(
          children: [
            ClipOval(
              child: Image.memory(
                base64Decode(this.icon.split(",")[1]),
                width: 30,
                height: 30,
                fit: BoxFit.cover,
              ),
            ),
            SizedBox(width: 5),
            Expanded(
              child: new Text(
                this.name.toUpperCase(),
                style: TextStyle(color: Colors.blue, fontSize: 12)
              )
            )
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
