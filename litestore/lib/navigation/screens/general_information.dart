import 'package:flutter/material.dart';
import 'package:litestore/api.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:litestore/widgets/social_link.dart';
import 'package:litestore/widgets/phone_number_link.dart';
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';

class GeneralInformationPage extends StatefulWidget {
  GeneralInformationPage({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _GeneralInformationPageState createState() => _GeneralInformationPageState();
}

class _GeneralInformationPageState extends State<GeneralInformationPage> {

  final jsonEncoder = JsonEncoder();
  final jsonDecoder = JsonDecoder();
  Map<String, dynamic> _giData = {};
  List<dynamic> _scData = [];
  bool _loading = true;

  _GeneralInformationPageState() {
    _getGiData();
    _getScData();
  }

  void _getGiData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    Map<String, dynamic> tempList = {};
    try {
      final request = await Api.getGeneralInformation();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        tempList = json.decode(responseBody);
        setState(() {
          _loading = false;
          _giData = tempList;
        });
        await prefs.setString('_giData', this.jsonEncoder.convert(tempList));
      } else {
        setState(() => _loading = false);
        print('Failed to get general information');
      }
    } on Exception {
      tempList = this.jsonDecoder.convert(await prefs.getString('_giData'));
      setState(() {
        _loading = false;
        _giData = tempList;
      });
    }
  }

  void _getScData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    List<dynamic> tempList = [];
    try {
      final request = await Api.getSocialChannel();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        tempList.addAll(json.decode(responseBody));
        setState(() => _scData = tempList);
        await prefs.setString('_scData', this.jsonEncoder.convert(tempList));
      } else {
        print('Failed to get social channel');
      }
    } on Exception {
      tempList = this.jsonDecoder.convert(await prefs.getString('_scData'));
      setState(() => _scData = tempList);
    }
  }

  List<Widget> _renderGiData() {
    List<Widget> tempList = List();
    List<Widget> subTempList = List();
    tempList.addAll(<Widget>[
      Text(
        this._giData['name'],
        style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold)
      ),
      SizedBox(height: 10),
      Text(this._giData['description']),
      SizedBox(height: 10),
      Text(
        "Alamat:",
        style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold)
      ),
      SizedBox(height: 3),
      Center(child: Html(data: this._giData['address'])),
      Text("Unit Matawang: " + this._giData['currency_unit']),
      SizedBox(height: 10),
    ]);
    subTempList.add(Text(
        "Hubungi Kami:",
        style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold)
    ));
    subTempList.add(SizedBox(height: 3));
    if (this._giData['email'] != null || this._giData['email'] != '') {
      subTempList.add(
        PhoneNumberLink(
          name: this._giData['email'],
          icon: new Icon(Icons.email, size: 20, color: Colors.black),
          url: "mailto:" + this._giData['email'],
        )
      );
    }
    if (this._giData['office_number'] != null || this._giData['office_number'] != '') {
      subTempList.add(
        PhoneNumberLink(
          name: this._giData['office_number'],
          icon: new Icon(Icons.phone, size: 20, color: Colors.black),
          url: "tel:" + this._giData['office_number'],
        )
      );
    }
    if (this._giData['mobile_number'] != null || this._giData['mobile_number'] != '') {
      subTempList.add(
        PhoneNumberLink(
          name: this._giData['mobile_number'],
          icon: new Icon(Icons.phone_android, size: 20, color: Colors.black),
          url: "tel:" + this._giData['mobile_number'],
        )
      );
    }
    if (this._giData['mobile_number'] != null || this._giData['mobile_number'] != '') {
      subTempList.add(
        PhoneNumberLink(
          name: this._giData['mobile_number'],
          icon: new Icon(Icons.sms, size: 20, color: Colors.black),
          url: "sms:" + this._giData['mobile_number'],
        )
      );
    }
    final subWidget = new Row(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: <Widget>[
        new Expanded(
          child: new Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: subTempList
          )
        ),
        new Expanded(
          child: new Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: _renderScData()
          )
        ),
      ]
    );
    tempList.add(subWidget);
    return tempList;
  }

  List<Widget> _renderScData() {
    List<Widget> tempList = [
      Text(
        "Saluran Sosial:",
        style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold)
      )
    ];
    for (var item in this._scData) {
      tempList.add(SocialLink.fromJson(item));
    }
    return tempList;
  }

  Widget _renderData() {
    if(this._giData.length > 0) {
      final children = _renderGiData();
      return new Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: children,
      );
    } else {
      return new Center();
    }
  }

  @override
  Widget build(BuildContext context) {

    return Container(
      child: Scaffold(
        appBar: AppBar(
          title: Text(widget.title),
        ),
        body: this._loading == true
        ? new Center(child: new CircularProgressIndicator())
        : new Container(
          color: Colors.grey[100],
          child: new Column(
            children: <Widget>[
              new Expanded(
                child: new ListView(
                  scrollDirection: Axis.vertical,
                  padding: EdgeInsets.all(30.0),
                  children: <Widget>[
                    _renderData()
                  ]
                )
              )
            ]
          ),
        )
      )
    );
  }
}
