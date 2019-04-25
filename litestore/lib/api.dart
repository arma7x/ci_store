import 'dart:io';
import 'dart:core';

class Api {

  static const String BASE_URL = 'pwalitestore.herokuapp.com';
  static const String PRODUCT_CATEGORY = 'api/product/category';
  static const String PRODUCT_SPOTLIGHT = 'api/product/spotlight';
  static const String PRODUCT_VIEW = 'api/product/view';
  static const String PRODUCT_SEARCH = 'api/product/search';
  static const String GENERAL_INFORMATION = 'api/other/general_information';
  static const String ESSENTIAL_INFORMATION = 'api/other/essential_information';
  static const String SOCIAL_CHANNEL = 'api/other/social_channel';
  static const String INBOX_CHANNEL = 'api/other/inbox_channel';

  static Future getProductCategory() {
    final url = Uri.https(BASE_URL, PRODUCT_CATEGORY);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future getProductSpotlight() {
    final url = Uri.https(BASE_URL, PRODUCT_SPOTLIGHT);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future viewProduct(String slug) {
    final url = Uri.https(BASE_URL, PRODUCT_VIEW + '/' + slug);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future searchProduct(Map<String, String> query) {
    final url = Uri.https(BASE_URL, PRODUCT_SEARCH, query);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future getGeneralInformation() {
    final url = Uri.https(BASE_URL, GENERAL_INFORMATION);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future getEssentialInformation() {
    final url = Uri.https(BASE_URL, ESSENTIAL_INFORMATION);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future viewEssentialInformation(String slug) {
    final url = Uri.https(BASE_URL, ESSENTIAL_INFORMATION + '/' + slug);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future getSocialChannel() {
    final url = Uri.https(BASE_URL, SOCIAL_CHANNEL);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }

  static Future getInboxChannel() {
    final url = Uri.https(BASE_URL, INBOX_CHANNEL);
    final httpClient = HttpClient();
    return httpClient.getUrl(url);
  }
}
