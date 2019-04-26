import 'package:flutter/material.dart';
import 'package:litestore/api.dart';
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:litestore/widgets/info_button.dart';

//class EssentialInformation extends StatelessWidget {

  //@override
  //Widget build(BuildContext context) {
    //return new EssentialInformationPage(title: 'Maklumat Penting');
  //}

//}

class EssentialInformationPage extends StatefulWidget {
  EssentialInformationPage({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _EssentialInformationPageState createState() => _EssentialInformationPageState();
}

class _EssentialInformationPageState extends State<EssentialInformationPage> {

  final jsonEncoder = JsonEncoder();
  final jsonDecoder = JsonDecoder();
  List<dynamic> _eiData = [];
  bool _loading = true;
  bool _ignoring = false;

  _EssentialInformationPageState() {
    _getEiData();
  }

  void _getEiData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    List<dynamic> tempList = [];
    try {
      final request = await Api.getEssentialInformation();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.transform(utf8.decoder).join();
        tempList = json.decode(responseBody);
        setState(() {
          _eiData = tempList;
          _loading = false;
        });
        await prefs.setString('_eiData', this.jsonEncoder.convert(tempList));
      } else {
        setState(() => _loading = false);
        print('Failed to get general information');
      }
    } on Exception {
      tempList = this.jsonDecoder.convert(await prefs.getString('_eiData'));
      setState(() {
        _eiData = tempList;
        _loading = false;
      });
    }
  }

  void cb(bool status) {
    setState(() => _ignoring = status);
  }

  List<Widget> _renderEiData() {
    List<Widget> tempList = List();
    for (var item in this._eiData) {
      tempList.add(InfoButton.fromJson(item, cb));
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
        body: this._loading == true
        ? new Center(child: new CircularProgressIndicator())
        : IgnorePointer(
          ignoring: this._ignoring,
          child: new Container(
            color: Colors.grey[100],
            child: new Column(
              children: <Widget>[
                this._ignoring ? new LinearProgressIndicator() : SizedBox(height: 0, width: 0),
                new Expanded(
                  child: new ListView(
                    scrollDirection: Axis.vertical,
                    padding: EdgeInsets.all(30.0),
                    children: _renderEiData()
                  )
                )
              ]
            ),
          )
        )
      )
    );
  }
}
