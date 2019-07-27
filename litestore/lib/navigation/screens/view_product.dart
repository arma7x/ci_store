import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:litestore/api.dart';
import 'package:litestore/config.dart';
import 'package:litestore/widgets/social_link.dart';
import 'package:litestore/widgets/phone_number_link.dart';


class ViewProduct extends StatefulWidget {

  final String id;
  final String name;
  final String slug;
  final String price;
  final String visibility;
  final String spotlight;
  final String availability;
  final String mainPhoto;
  final String secondPhoto;
  final String thirdPhoto;
  final String fourthPhoto;
  final String briefDescription;
  final String fullDescription;
  final String createdAt;
  final String updatedAt;

  ViewProduct._({Key key, this.id, this.name, this.slug, this.price, this.visibility, this.spotlight, this.availability, this.mainPhoto, this.secondPhoto, this.thirdPhoto, this.fourthPhoto, this.briefDescription, this.fullDescription, this.createdAt, this.updatedAt});

  factory ViewProduct.fromJson(Map<String, dynamic> json) {
    return new ViewProduct._(
      id: json['id'],
      name: json['name'],
      slug: json['slug'],
      price: json['price'],
      visibility: json['visibility'],
      spotlight: json['spotlight'],
      availability: json['availability'],
      mainPhoto: json['main_photo'],
      secondPhoto: json['second_photo'],
      thirdPhoto: json['third_photo'],
      fourthPhoto: json['fourth_photo'],
      briefDescription: json['brief_description'],
      fullDescription: json['full_description'],
      createdAt: json['created_at'],
      updatedAt: json['updated_at'],
    );
  }

  @override
  _ViewProductState createState() => _ViewProductState();
}

class _ViewProductState extends State<ViewProduct> {

  final jsonEncoder = JsonEncoder();
  final jsonDecoder = JsonDecoder();
  Map<String, dynamic> _giData = {};
  List<dynamic> _icData = [];
  int _currentSlide = 0;
  bool _loading = true;

  _ViewProductState() {
    _getGiData();
    _getIcData();
  }

  void _getGiData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    Map<String, dynamic> tempList = {};
    try {
      final request = await Api.getGeneralInformation();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.cast<List<int>>().transform(utf8.decoder).join();
        tempList = json.decode(responseBody);
        setState(() {
          _giData = tempList;
          _loading = false;
        });
        await prefs.setString('_giData', this.jsonEncoder.convert(tempList));
      } else {
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_SHORT);
        setState(() => _loading = false);
      }
    } catch (exception) {
      Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_SHORT);
      tempList = this.jsonDecoder.convert(await prefs.getString('_giData'));
      setState(() {
        _giData = tempList;
        _loading = false;
      });
    }
  }

  void _getIcData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    List<dynamic> tempList = [];
    try {
      final request = await Api.getInboxChannel();
      final response = await request.close(); 
      if (response.statusCode == 200) {
        final responseBody = await response.cast<List<int>>().transform(utf8.decoder).join();
        tempList = json.decode(responseBody);
        setState(() {
          _icData = tempList;
          _loading = false;
        });
        await prefs.setString('_icData', this.jsonEncoder.convert(tempList));
      } else {
        Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_SHORT);
        setState(() => _loading = false);
      }
    } catch (exception) {
      Fluttertoast.showToast(msg: "Network Error", toastLength: Toast.LENGTH_SHORT);
      tempList = this.jsonDecoder.convert(await prefs.getString('_icData'));
      setState(() {
        _icData = tempList;
        _loading = false;
      });
    }
  }

  List<Widget> _renderOrderButton() {
    List<Widget> tempList = List();
    for (var item in this._icData) {
      item['name'] = '';
      item['url'] = item['url'].replaceAll("%param", widget.id + " - " + widget.name);
      tempList.add(SocialLink.fromJson(item));
      tempList.add(SizedBox(width: 5));
    }
    if (this._giData['mobile_number'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: '',
          icon: new Icon(Icons.sms, size: 20, color: Colors.white),
          url: "sms:" + this._giData['mobile_number'] + "?body=" + widget.id + " - " + widget.name,
        )
      );
    }
    if (this._giData['email'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: '',
          icon: new Icon(Icons.email, size: 20, color: Colors.white),
          url: "mailto:" + this._giData['email'] + "?subject=" + widget.id + " - " + widget.name + "&body=" + widget.id + " - " + widget.name,
        )
      );
    }
    if (this._giData['office_number'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: '',
          icon: new Icon(Icons.phone, size: 20, color: Colors.white),
          url: "tel:" + this._giData['office_number'],
        )
      );
    }
    if (this._giData['mobile_number'] != null) {
      tempList.add(
        PhoneNumberLink(
          name: '',
          icon: new Icon(Icons.phone_android, size: 20, color: Colors.white),
          url: "tel:" + this._giData['mobile_number'],
        )
      );
    }
    return tempList;
  }

  @override
  Widget build(BuildContext context) {

    Widget imageContainer(String url) {
      return new CachedNetworkImage(
        imageUrl: url,
        fit: BoxFit.fill,
        width: MediaQuery.of(context).size.width,
        height: MediaQuery.of(context).size.width,
        placeholder: (context, url) => new Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.width,
          padding: EdgeInsets.all(40),
          child: new Center(child: CircularProgressIndicator())
        ),
        errorWidget: (context, url, error) => new Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.width,
          padding: EdgeInsets.all(30),
          child: new Center(child: new Icon(Icons.error))
        ),
      );
    }

    List<Widget> availableImages() {
      List<Widget> images = [];
      if (widget.mainPhoto != '') {
        images.add(imageContainer(widget.mainPhoto));
      }
      if (widget.secondPhoto != '') {
        images.add(imageContainer(widget.secondPhoto));
      }
      if (widget.thirdPhoto != '') {
        images.add(imageContainer(widget.thirdPhoto));
      }
      if (widget.fourthPhoto != '') {
        images.add(imageContainer(widget.fourthPhoto));
      }
      return images;
    }

    List<Widget> dotIndicator() {
      List<Widget> indicator = [];
      for(int x = 0;x < availableImages().length;x++){
        if (x == this._currentSlide) {
          indicator.add(new Icon(Icons.brightness_1, size: 12, color: Config.THEME_COLOR));
        } else {
          indicator.add(new Icon(Icons.brightness_1, size: 12, color: Colors.grey));
        }
      }
      return indicator;
    }

    return Scaffold(
      appBar: AppBar(
        title: Text(widget.name),
      ),
      body: new Container(
        color: Colors.grey[50],
        child: new Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            new Expanded(
              child: new ListView(
                children: <Widget>[
                  CarouselSlider(
                    onPageChanged: (index) {
                      setState(() {
                        _currentSlide = index;
                      });
                    },
                    height: MediaQuery.of(context).size.width,
                    items: availableImages().map((child) {
                      return Builder(
                        builder: (BuildContext context) {
                          return Container(
                            width: MediaQuery.of(context).size.width,
                            decoration: BoxDecoration(
                              color: Colors.white
                            ),
                            child: child
                          );
                        },
                      );
                    }).toList(),
                  ),
                  new Container(
                    color: Colors.white,
                    child: new Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: dotIndicator()
                    )
                  ),
                  new Padding(
                    padding: const EdgeInsets.fromLTRB(20.0, 10.0, 20.0, 0.0),
                    child: new Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        new Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: <Widget>[
                            Text(
                              Config.CURRENCY_UNIT + double.parse(widget.price).toStringAsFixed(2),
                              style: TextStyle(color: Config.THEME_COLOR, fontSize: 23, fontWeight: FontWeight.bold)
                            ),
                            Text(
                              "#" + widget.id,
                              style: TextStyle(fontSize: 23, fontWeight: FontWeight.bold)
                            ),
                          ]
                        ),
                        SizedBox(height: 10),
                        new Text(
                          widget.name,
                          style: TextStyle(fontSize: 30, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 10),
                        new Row(
                          children: <Widget>[
                            new Icon(Icons.local_grocery_store, size: 12, color: Colors.grey),
                            SizedBox(width: 5),
                            new Text(
                              widget.availability == "1" ? "STOK TERSEDIA" : "KEHABISAN STOK",
                              overflow: TextOverflow.ellipsis,
                              style: TextStyle(color: widget.availability == "1" ? Colors.green : Colors.red)
                            ),
                          ]
                        ),
                        SizedBox(height: 10),
                        new Text(
                          "ORDER SINI!",
                          style: TextStyle(color: Colors.grey, fontSize: 20, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 5),
                        this._loading
                        ? new LinearProgressIndicator()
                        : new Container(
                          height: 65,
                          child: new ListView(
                            scrollDirection: Axis.horizontal,
                            children: _renderOrderButton()
                          )
                        ),
                        SizedBox(height: 10),
                        new Text(
                          widget.briefDescription,
                          style: TextStyle(color: Colors.grey, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 20),
                        new Center(child: new Container(color:Config.THEME_COLOR, height: 4, width: 180)),
                        Html(data: widget.fullDescription)
                      ]
                    )
                  )
                ]
              )
            ),
          ]
        ),
      )
    );
  }

}
