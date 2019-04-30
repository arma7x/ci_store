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

    return new GestureDetector(
      child: new Container(
        margin: const EdgeInsets.fromLTRB(0.0, 5.0, 0.0, 5.0),
        child: new Row(
          children: [
            this.icon,
            this.name != '' ? SizedBox(width: 5) : SizedBox(width: 0),
            this.name != '' ? Expanded(
              child: new Text(
                this.name,
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
