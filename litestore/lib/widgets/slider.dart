import 'package:flutter/material.dart';

class WidgetSlider extends StatefulWidget {
  final List<ImageProvider> slides;

  WidgetSlider({this.slides});

  @override
  _WidgetSliderState createState() => _WidgetSliderState();
}

class _WidgetSliderState extends State<WidgetSlider> {

  int currentSlide = 0;

  @override
  Widget build(BuildContext context) {
    return new Container(
      constraints: new BoxConstraints.expand(
        width: MediaQuery.of(context).size.width,
        height: MediaQuery.of(context).size.width,
      ),
      alignment: Alignment.bottomLeft,
      padding: new EdgeInsets.only(left: 10.0, bottom: (MediaQuery.of(context).size.width/2), right: 10.0),
      decoration: new BoxDecoration(
        image: new DecorationImage(
          image: widget.slides[this.currentSlide],
          fit: BoxFit.cover,
        ),
      ),
      child: new Stack(
        children: <Widget>[
          new Positioned(
            left: 0.0,
            bottom: 0.0,
            child: new GestureDetector(
              child: new Icon(Icons.navigate_before, size: 40, color: Colors.blue),
              onTap: () {
                final nextSlide = this.currentSlide - 1;
                if (nextSlide < 0) {
                  setState(() => currentSlide = (widget.slides.length - 1));
                } else {
                  setState(() => currentSlide = nextSlide);
                }
              },
            ),
          ),
          new Positioned(
            right: 0.0,
            bottom: 0.0,
            child: new GestureDetector(
              child: new Icon(Icons.navigate_next, size: 40, color: Colors.blue),
              onTap: () {
                final nextSlide = this.currentSlide + 1;
                if (nextSlide > (widget.slides.length - 1)) {
                  setState(() => currentSlide = 0);
                } else {
                  setState(() => currentSlide = nextSlide);
                }
              },
            ),
          ),
        ],
      )
    );
  }
}
