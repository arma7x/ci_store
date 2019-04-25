import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart' show CupertinoPageRoute;
import 'package:litestore/navigation/screens.dart';
import 'package:cached_network_image/cached_network_image.dart';

class Product extends StatelessWidget {

  final String id;
  final String name;
  final String slug;
  final String price;
  final String briefDescription;
  final String spotlight;
  final String availability;
  final String mainPhoto;

  Product._({Key key, this.id, this.name, this.slug, this.price, this.briefDescription, this.spotlight, this.availability, this.mainPhoto});

  factory Product.fromJson(Map<String, dynamic> json) {
    return new Product._(
      id: json['id'],
      name: json['name'],
      slug: json['slug'],
      price: json['price'],
      briefDescription: json['brief_description'],
      spotlight: json['spotlight'],
      availability: json['availability'],
      mainPhoto: json['main_photo'],
    );
  }

  @override
  Widget build(BuildContext context) {
    return new GestureDetector(
      child: new Container(
        decoration: new BoxDecoration(
          color: Colors.white,
          border: new Border(
            bottom: BorderSide(
              color: Colors.grey[100],
              width: 2,
            )
          )
        ),
        child: new Row(
          children: <Widget>[
            new CachedNetworkImage(
              imageUrl: this.mainPhoto,
              fit: BoxFit.fill,
              width: 100,
              height: 100,
              placeholder: (context, url) => new Container(
                width: 100,
                height: 100,
                padding: EdgeInsets.all(40),
                child: new CircularProgressIndicator()
              ),
              errorWidget: (context, url, error) => new Container(
                width: 100,
                height: 100,
                padding: EdgeInsets.all(30),
                child: new Icon(Icons.error)
              ),
            ),
            new Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                new Text(
                  this.name,
                  overflow: TextOverflow.ellipsis,
                  style: TextStyle(
                    color: Colors.black,
                    fontSize: 14
                  )
                ),
                SizedBox(height: 10),
                new Row(
                  children: <Widget>[
                    new Icon(Icons.fingerprint, size: 12, color: Colors.grey),
                    SizedBox(width: 5),
                    new Text(
                      this.id,
                      overflow: TextOverflow.ellipsis,
                      style: TextStyle(color: Colors.grey)
                    ),
                  ]
                ),
                SizedBox(height: 2),
                new Row(
                  children: <Widget>[
                    new Icon(Icons.local_offer, size: 12, color: Colors.grey),
                    SizedBox(width: 5),
                    new Text(
                      "RM" + double.parse(this.price).toStringAsFixed(2),
                      overflow: TextOverflow.ellipsis,
                      style: TextStyle(color: Colors.grey)
                    ),
                  ]
                ),
                SizedBox(height: 2),
                new Row(
                  children: <Widget>[
                    new Icon(Icons.widgets, size: 12, color: Colors.grey),
                    SizedBox(width: 5),
                    new Text(
                      this.availability == "1" ? "DALAM STOK" : "KEHABISAN STOK",
                      overflow: TextOverflow.ellipsis,
                      style: TextStyle(color: this.availability == "1" ? Colors.green : Colors.red)
                    ),
                  ]
                ),
              ]
            )
          ]
        ),
      ),
      onTap: () {
        Navigator.push(
          context,
          CupertinoPageRoute(builder: (BuildContext context) => new ProductData())
        );
      },
    );
  }
}

