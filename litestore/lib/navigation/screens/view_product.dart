import 'package:flutter/material.dart';
import 'package:litestore/widgets/slider.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter_html/flutter_html.dart';

class ViewProduct extends StatelessWidget {

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
  Widget build(BuildContext context) {

    ImageProvider imageContainer(String url) {
      return new CachedNetworkImageProvider(url);
    }

    List<ImageProvider> availableImages() {
      List<ImageProvider> images = [];
      if (this.mainPhoto != '') {
        images.add(imageContainer(this.mainPhoto));
      }
      if (this.secondPhoto != '') {
        images.add(imageContainer(this.secondPhoto));
      }
      if (this.thirdPhoto != '') {
        images.add(imageContainer(this.thirdPhoto));
      }
      if (this.fourthPhoto != '') {
        images.add(imageContainer(this.fourthPhoto));
      }
      return images;
    }

    return Scaffold(
      appBar: AppBar(
        title: Text(this.name),
      ),
      body: new Container(
        color: Colors.grey[50],
        child: new Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            new Expanded(
              child: new ListView(
                children: <Widget>[
                  new WidgetSlider(slides: availableImages()),
                  new Padding(
                    padding: const EdgeInsets.fromLTRB(20.0, 10.0, 20.0, 0.0),
                    child: new Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        new Text(
                          "#" + this.id + "/RM" + double.parse(this.price).toStringAsFixed(2),
                          style: TextStyle(color: Colors.blue, fontSize: 23, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 10),
                        new Text(
                          this.name,
                          style: TextStyle(fontSize: 30, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 10),
                        new Row(
                          children: <Widget>[
                            new Icon(Icons.widgets, size: 12, color: Colors.grey),
                            SizedBox(width: 5),
                            new Text(
                              this.availability == "1" ? "DALAM STOK" : "TIDALAM STOK",
                              overflow: TextOverflow.ellipsis,
                              style: TextStyle(color: this.availability == "1" ? Colors.green : Colors.red)
                            ),
                          ]
                        ),
                        SizedBox(height: 10),
                        new Text(
                          'ORDER SINI',
                          style: TextStyle(color: Colors.grey, fontSize: 20, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 10),
                        new Text(
                          this.briefDescription,
                          style: TextStyle(color: Colors.grey, fontWeight: FontWeight.bold)
                        ),
                        SizedBox(height: 20),
                        Html(data: this.fullDescription)
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
