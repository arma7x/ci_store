import 'package:flutter/material.dart';
import 'package:flutter_html/flutter_html.dart';

class ViewEssentialInformation extends StatelessWidget {

  final String slug;
  final String title;
  final String position;
  final String visibility;
  final String materialIcon;
  final String briefDescription;
  final String fullDescription;
  final String updatedAt;

  ViewEssentialInformation._({Key key, this.slug, this.title, this.position, this.visibility, this.materialIcon, this.briefDescription, this.fullDescription, this.updatedAt});

  @override
  factory ViewEssentialInformation.fromJson(Map<String, dynamic> json) {
    return new ViewEssentialInformation._(
      slug: json['slug'],
      title: json['title'],
      position: json['position'],
      visibility: json['visibility'],
      materialIcon: json['material_icon'],
      briefDescription: json['brief_description'],
      fullDescription: json['full_description'],
      updatedAt: json['updated_at'],
    );
  }

  @override
  Widget build(BuildContext context) {

    int icon;
    try {
      icon = int.parse(this.materialIcon.replaceAll("&#", '0').replaceAll(";", ''));
    } catch (exception) {
      icon = 0xe14b;
    }

    return Scaffold(
      appBar: AppBar(
        title: Row(
          children: <Widget>[
            Icon(IconData(icon, fontFamily: 'MaterialIcons')),
            SizedBox(width: 5),
            Text(this.title)
          ]
        ),
      ),
      body: new Container(
        child: new ListView(
          scrollDirection: Axis.vertical,
          padding: EdgeInsets.all(30.0),
          children: <Widget>[Html(data: this.fullDescription)]
        )
      )
    );
  }

}
