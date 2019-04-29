import 'package:flutter/material.dart';
import 'package:litestore/widgets/slider.dart';
import 'package:cached_network_image/cached_network_image.dart';

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
      body: new Center(
        child: new Column(
          children: <Widget>[
            new WidgetSlider(slides: availableImages()),
            new Text(this.name),
          ]
        ),
      )
    );
  }

}
