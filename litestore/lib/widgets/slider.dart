import 'package:flutter/material.dart';

class WidgetSlider extends StatefulWidget {
  final List<ImageProvider> slides;

  WidgetSlider({this.slides});

  @override
  _WidgetSliderState createState() => _WidgetSliderState();
}

class _WidgetSliderState extends State<WidgetSlider> {

  int currentSlide = 0;

  List<Widget> dotIndicator() {
    List<Widget> indicator = [];
    for(int x = 0;x < widget.slides.length;x++){
      if (x == this.currentSlide) {
        indicator.add(new Icon(Icons.brightness_1, size: 12, color: Colors.blue));
      } else {
        indicator.add(new Icon(Icons.brightness_1, size: 12, color: Colors.grey));
      }
    }
    return indicator;
  }

  @override
  Widget build(BuildContext context) {
    return new Container(
      constraints: new BoxConstraints.expand(
        width: MediaQuery.of(context).size.width,
        height: MediaQuery.of(context).size.width,
      ),
      alignment: Alignment.bottomLeft,
      padding: new EdgeInsets.only(left: 10.0, top: (MediaQuery.of(context).size.width/2), right: 10.0),
      decoration: new BoxDecoration(
        color: Colors.white,
        image: new DecorationImage(
          image: widget.slides[this.currentSlide],
          fit: BoxFit.cover,
        ),
      ),
      child: new Stack(
        children: <Widget>[
          new Positioned(
            left: 0.0,
            top: 0.0,
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
            width: (MediaQuery.of(context).size.width - 40),
            left: 10,
            top: (MediaQuery.of(context).size.width/2) - 30,
            child: new Center(
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: dotIndicator(),
                )
              ),
          ),
          new Positioned(
            right: 0.0,
            top: 0.0,
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
