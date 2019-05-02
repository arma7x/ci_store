import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:litestore/api.dart';
import 'package:litestore/widgets/social_link.dart';
import 'package:litestore/config.dart';
import 'package:litestore/widgets/phone_number_link.dart';

class InboxChannelPage extends StatefulWidget {
  InboxChannelPage({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _InboxChannelPageState createState() => _InboxChannelPageState();
}

class _InboxChannelPageState extends State<InboxChannelPage> {

  final jsonEncoder = JsonEncoder();
  final jsonDecoder = JsonDecoder();
  Map<String, dynamic> _giData = {};
  List<dynamic> _icData = [];

  _InboxChannelPageState() {
    _getGiData();
    _getIcData();
  }

  void _getGiData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    Map<String, dynamic> tempList = {};
    tempList = this.jsonDecoder.convert(await prefs.getString('_giData'));
    setState(() => _giData = tempList);
  }

  void _getIcData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    List<dynamic> tempList = [];
    tempList = this.jsonDecoder.convert(await prefs.getString('_icData'));
    setState(() => _icData = tempList);
  }

  List<Widget> _renderGiData() {
    List<Widget> tempList = List();
    tempList.add(Text(
      'Telefon/Mesej/Email:',
      style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold)
    ));
    tempList.add(SizedBox(height: 5));
    if (this._giData['email'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: this._giData['email'],
          icon: new Icon(Icons.email, size: 20, color: Colors.white),
          url: "mailto:" + this._giData['email'],
        )
      );
    }
    if (this._giData['office_number'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: this._giData['office_number'],
          icon: new Icon(Icons.phone, size: 20, color: Colors.white),
          url: "tel:" + this._giData['office_number'],
        )
      );
    }
    if (this._giData['mobile_number'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: this._giData['mobile_number'],
          icon: new Icon(Icons.phone_android, size: 20, color: Colors.white),
          url: "tel:" + this._giData['mobile_number'],
        )
      );
    }
    if (this._giData['mobile_number'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: this._giData['mobile_number'],
          icon: new Icon(Icons.sms, size: 20, color: Colors.white),
          url: "sms:" + this._giData['mobile_number'],
        )
      );
    }
    return tempList;
  }

  List<Widget> _renderIcData() {
    List<Widget> tempList = List();
    tempList.add(Text(
      'Hantar Pesanan:',
      style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold)
    ));
    tempList.add(SizedBox(height: 10));
    for (var item in this._icData) {
      item['url'] = item['url'].replaceAll("%param", 'Hi ' + Config.APP_NAME);
      tempList.add(SocialLink.fromJson(item));
      tempList.add(SizedBox(height: 10));
    }
    return tempList;
  }

  @override
  Widget build(BuildContext context) {

    return Container(
      child: Scaffold(
        appBar: AppBar(
          title: Text(widget.title),
        ),
        body: new Container(
          color: Colors.grey[100],
          child: new Row(
            children: <Widget>[
              new Expanded(
                child: new ListView(
                  scrollDirection: Axis.vertical,
                  padding: EdgeInsets.fromLTRB(30.0, 30.0, 0.0, 30.0),
                  children: _renderIcData()
                )
              ),
              new Expanded(
                child: new ListView(
                  scrollDirection: Axis.vertical,
                  padding: EdgeInsets.fromLTRB(0.0, 30.0, 30.0, 30.0),
                  children: _renderGiData()
                )
              )
            ]
          )
        )
      )
    );
  }
}
