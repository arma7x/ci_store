import 'package:flutter/material.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:carousel_slider/carousel_slider.dart';


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

  int _currentSlide = 0;

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
          child: new CircularProgressIndicator()
        ),
        errorWidget: (context, url, error) => new Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.width,
          padding: EdgeInsets.all(30),
          child: new Icon(Icons.error)
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
          indicator.add(new Icon(Icons.brightness_1, size: 12, color: Colors.blue));
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
                    padding: const EdgeInsets.fromLTRB(30.0, 10.0, 30.0, 0.0),
                    child: new Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        new Text(
                          "#" + widget.id + "/RM" + double.parse(widget.price).toStringAsFixed(2),
                          style: TextStyle(color: Colors.blue, fontSize: 23, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 10),
                        new Text(
                          widget.name,
                          style: TextStyle(fontSize: 30, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 10),
                        new Row(
                          children: <Widget>[
                            new Icon(Icons.widgets, size: 12, color: Colors.grey),
                            SizedBox(width: 5),
                            new Text(
                              widget.availability == "1" ? "DALAM STOK" : "TIADA STOK",
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
                        SizedBox(height: 10),
                        new Text(
                          widget.briefDescription,
                          style: TextStyle(color: Colors.grey, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 20),
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
