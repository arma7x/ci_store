import 'package:flutter/material.dart';

class Catalog extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return new CatalogPage(title: 'Catalog');
  }

}

class CatalogPage extends StatefulWidget {
  CatalogPage({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _CatalogPageState createState() => _CatalogPageState();
}

class _CatalogPageState extends State<CatalogPage> {
  int _counter = 0;

  void _incrementCounter() {
    setState(() {
      _counter++;
    });
  }

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      child: Scaffold(
        appBar: AppBar(
          title: Text(widget.title),
        ),
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Text(
                'You have pushed the button this many times:',
              ),
              Text(
                '$_counter',
                style: Theme.of(context).textTheme.display1,
              ),
            ],
          ),
        ),
        floatingActionButton: FloatingActionButton(
          onPressed: _incrementCounter,
          tooltip: 'Increment Counter',
          child: Icon(Icons.add),
        ),
      ),
      onTap: () {
        setState(() {
          _counter = 0;
        });
        print('Set counter to zero');
      },
    );
  }
}
