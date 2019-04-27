import 'package:litestore/navigation/fragments.dart';
import 'package:litestore/navigation/screens.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:litestore/api.dart';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart' show CupertinoPageRoute;

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Lite Store',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: MyHomePage(),
    );
  }
}

class DrawerItem {
  String title;
  IconData icon;
  Function body;
  DrawerItem(this.title, this.icon, this.body);
}

class MyHomePage extends StatefulWidget {

  final drawerFragments = [
    new DrawerItem("Halaman Utama", Icons.home, () => new Home())
  ];

  final drawerScreens = [
    new DrawerItem("Katalog", Icons.shop, () => new CatalogPage(title: 'Katalog', category: '', name: 'Pelbagai Kategori')),
    new DrawerItem("Maklumat Penting", Icons.description, () =>  new EssentialInformationPage(title: 'Maklumat Penting')),
    new DrawerItem("Kotak Pertanyaan", Icons.email, () => new InboxChannelPage(title: 'Kotak Pertanyaan')),
    new DrawerItem("Maklumat Umum", Icons.info, () => new GeneralInformationPage(title: 'Maklumat Umum'))
  ];

  MyHomePage({Key key}) : super(key: key);

  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {

  int _selectedDrawerFragmentIndex = 0;

  _getDrawerFragmentWidgetIndex(int pos) {
    if (widget.drawerFragments[pos] != null) {
      return widget.drawerFragments[pos].body();
    } else {
      return new Text("Error");
    }
  }
  
  _onSelectFragment(int index) {
    setState(() => _selectedDrawerFragmentIndex = index);
    Navigator.of(context).pop();
  }
  
  _onSelectScreen(int index) {
    if (widget.drawerScreens[index] != null) {
      Navigator.of(context).pop(); // close drawer
      Navigator.push(
        context,
        CupertinoPageRoute(builder: (BuildContext context) => widget.drawerScreens[index].body())
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    List<Widget> drawerOptions = [];

    for (var i = 0; i < widget.drawerFragments.length; i++) {
      var d = widget.drawerFragments[i];
      drawerOptions.add(
        new ListTile(
          leading: new Icon(d.icon),
          title: new Text(d.title),
          selected: i == _selectedDrawerFragmentIndex,
          onTap: () => _onSelectFragment(i),
        )
      );
    }

    for (var i = 0; i < widget.drawerScreens.length; i++) {
      var d = widget.drawerScreens[i];
      drawerOptions.add(
        new ListTile(
          leading: new Icon(d.icon),
          title: new Text(d.title),
          onTap: () => _onSelectScreen(i),
        )
      );
    }

    return new Scaffold(
      appBar: new AppBar(
        title: new Text(widget.drawerFragments[_selectedDrawerFragmentIndex].title),
      ),
      drawer: new SizedBox(
        width: MediaQuery.of(context).size.width * 0.80,
        child: new Drawer(
          child: new Column(
            children: <Widget>[
              new UserAccountsDrawerHeader(
                accountName: new Text("Lite Store", style: TextStyle(fontSize: 16)),
                accountEmail: new Text(
                  "REG0123456789MY",
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold
                  )
                ),
                currentAccountPicture: CircleAvatar(
                  backgroundColor: Colors.white,
                  backgroundImage: CachedNetworkImageProvider("https://" + Api.BASE_URL + "/static/img/android-chrome-512x512.png"),
                ),
              ),
              new Column(children: drawerOptions)
            ],
          ),
        ),
      ),
      body: _getDrawerFragmentWidgetIndex(_selectedDrawerFragmentIndex),
    );
  }
}
