import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:litestore/config.dart';

class PhoneNumberLink extends StatelessWidget {

  final String name;
  final Widget icon;
  final String url;

  PhoneNumberLink({Key key, this.name, this.icon, this.url});

  PhoneNumberLink._({Key key, this.name, this.icon, this.url});

  factory PhoneNumberLink.fromJson(Map<String, dynamic> json) {
    return new PhoneNumberLink._(
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

    return new Container(
      child: new Row(
        children: [
          new FloatingActionButton(
            heroTag: this.name,
            onPressed: () {
              _openApp(this.url);
            },
            mini: true,
            child: this.icon,
          ),
          this.name != '' ? SizedBox(width: 5) : SizedBox(width: 0),
          this.name != '' ? Expanded(
            child: new GestureDetector(
              child: new Text(
                this.name,
                style: TextStyle(color: Config.THEME_COLOR, fontSize: 12)
              ),
              onTap: () {
                _openApp(this.url);
              }
            )
          ) : SizedBox(width: 0)
        ]
      ),
    );
  }
}
