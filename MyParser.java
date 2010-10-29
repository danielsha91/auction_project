/* Instructions:

   This program processes all files passed on the command line (to parse
   an entire diectory, type "java MyParser myFiles/*.xml" at the shell).

   At the point noted below, an individual XML file has been parsed into a
   DOM Document node. You should fill in code to process the node. Java's
   interface for the Document Object Model (DOM) is in package
   org.w3c.dom. The documentation is available online at
   
   http://www.w3.org/2003/01/dom2-javadoc/org/w3c/dom/package-summary.html

   A tutorial of DOM can be found at:

   http://www.w3schools.com/dom/default.asp

   Some auxiliary methods have been written for you. You may find them
   useful.

   */


import java.io.*;
import java.text.*;
import java.util.*;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.FactoryConfigurationError;
import javax.xml.parsers.ParserConfigurationException;
import org.w3c.dom.Document;
import org.w3c.dom.Node;
import org.w3c.dom.Element;
import org.w3c.dom.Text;
import org.xml.sax.SAXException;
import org.xml.sax.SAXParseException;
import org.xml.sax.ErrorHandler;


class MyParser {

  static final String columnSeparator = "<>";
  static DocumentBuilder builder;
    
  static final String[] typeName = {
      "none",
      "Element",
      "Attr",
      "Text",
      "CDATA",
      "EntityRef",
      "Entity",
      "ProcInstr",
      "Comment",
      "Document",
      "DocType",
      "DocFragment",
      "Notation",
  };

  static class MyErrorHandler implements ErrorHandler {

    public void warning(SAXParseException exception)
	 throws SAXException {
	   fatalError(exception);
    }
    
    public void error(SAXParseException exception)
	 throws SAXException {
	   fatalError(exception);
    }

    public void fatalError(SAXParseException exception)
	 throws SAXException {
	   exception.printStackTrace();
	   System.out.println("There should be no errors " +
			      "in the supplied XML files.");
	   System.exit(3);
    }

  }
    
  /* Non-recursive (NR) version of Node.getElementsByTagName(...) */
  static Element[] getElementsByTagNameNR(Element e, String tagName) {
    Vector< Element > elements = new Vector< Element >();
    Node child = e.getFirstChild();
    while (child != null) {
      if (child instanceof Element && child.getNodeName().equals(tagName))
      {
         elements.add( (Element)child );
      }
      child = child.getNextSibling();
    }
    Element[] result = new Element[elements.size()];
    elements.copyInto(result);
    return result;
  }
  
  /* Returns the first subelement of e matching the given tagName, or
   * null if one does not exist. */
  static Element getElementByTagNameNR(Element e, String tagName) {
    Node child = e.getFirstChild();
    while (child != null) {
      if (child instanceof Element && child.getNodeName().equals(tagName))
	return (Element) child;
      child = child.getNextSibling();
    }
    return null;
  }

  /* Returns the text associated with the given element (which must have
   * type #PCDATA) as child, or "" if it contains no text. */
  static String getElementText(Element e) {
    if (e.getChildNodes().getLength() == 1) {
      Text elementText = (Text) e.getFirstChild();
      return elementText.getNodeValue();
    }
    else
      return "";
  }

  /* Returns the text (#PCDATA) associated with the first subelement X
   * of e with the given tagName. If no such X exists or X contains no
   * text, "" is returned. */
  static String getElementTextByTagNameNR(Element e, String tagName) {
    Element elem = getElementByTagNameNR(e, tagName);
    if (elem != null)
      return getElementText(elem);
    else
      return "";
  }

  /* Returns the amount (in XXXXX.xx format) denoted by a dollar-value
   * string like $3,453.23. Returns the input if the input is an empty
   * string. */
  static String formatDollar(String money) {
    if (money.equals(""))
      return money;
    else {
      double am = 0.0;
      NumberFormat nf = NumberFormat.getCurrencyInstance(Locale.US);
      try { am = nf.parse(money).doubleValue(); }
      catch (ParseException e) {
	System.out.println("This method should work for all " +
			   "money values you find in our data.");
	System.exit(20);
      }
      nf.setGroupingUsed(false);
      return nf.format(am).substring(1);
    }
  }
  
  /* Returns the time (in YYYY-MM-DD HH:MM:SS format) denoted by a
   * time string like Dec-31-01 23:59:59. */
  static String formatTime(String time) {
    DateFormat outputDf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
    DateFormat inputDf = new SimpleDateFormat("MMM-dd-yy HH:mm:ss");
    String result = "";
    try { result = outputDf.format(inputDf.parse(time)); }
    catch (ParseException e) {
      System.out.println("This method should work for all date/" +
                         "time strings you find in our data.");
      System.exit(20);
    }
    return result;
  }
  
  /* Process one items-???.xml file. */
  static void processFile(File xmlFile) {
    Document doc = null;
    try {
      doc = builder.parse(xmlFile);
    }
    catch (IOException e) {
      e.printStackTrace();
      System.exit(3);
    }
    catch (SAXException e) {
      System.out.println("Parsing error on file " + xmlFile);
      System.out.println("  (not supposed to happen with supplied XML files)");
      e.printStackTrace();
      System.exit(3);
    }

    /* At this point 'doc' contains a DOM representation of an 'Items' XML
     * file. Use doc.getDocumentElement() to get the root Element. */
    System.out.println("Successfully parsed - " + xmlFile);

    /* Fill in code here (you will probably need to write auxiliary
       methods). */

    

    /**************************************************************/
    String sep = "<>";
    String newline = System.getProperty("line.separator");
    try {
      // prepare output file
      // these are not necessarily final load file
      // instead, following steps like sort|uniq might be needed
      BufferedWriter bwItem
        = new BufferedWriter(new FileWriter("./Item_raw.dat", true));
      BufferedWriter bwItemCategory
        = new BufferedWriter(new FileWriter("./ItemCategory_raw.dat", true));
      BufferedWriter bwAuctionSeller
        = new BufferedWriter(new FileWriter("./AuctionSeller_raw.dat", true));
      BufferedWriter bwAuctionBidder
        = new BufferedWriter(new FileWriter("./AuctionBidder_raw.dat", true));
      BufferedWriter bwBid
        = new BufferedWriter(new FileWriter("./Bid_raw.dat", true));

      // loop through all Item elements in a xml file
      Element docElement = doc.getDocumentElement();
      Element[] items = getElementsByTagNameNR(docElement, "Item");
      for (Element item : items) {
        // get Item element
        String itemId = item.getAttribute("ItemID");

        // get all relevant fields in Item table
        String name        = getFieldText(item, "Name");
        String firstPrice  = formatDollar(getFieldText(item, "First_Bid"));
        String started     = formatTime(getFieldText(item, "Started"));
        String ends        = formatTime(getFieldText(item, "Ends"));
        String description = getFieldText(item, "Description");
        String buyPrice    = "NULL";
        // account for empty field cases
        Element buyPriceElement = getElementByTagNameNR(item, "Buy_Price");
        if (buyPriceElement != null) {
            buyPrice = formatDollar(getElementText(buyPriceElement));
        }
  
        // get seller information
        Element seller = getElementByTagNameNR(item, "Seller");
        String sellerId = seller.getAttribute("UserID");
        String sellerRating = seller.getAttribute("Rating");
        String sellerLocation = getFieldText(item, "Location");
        String sellerCountry = getFieldText(item, "Country");
  
        // output to Item
        bwItem.write(itemId + sep + name + sep +
                     buyPrice + sep + firstPrice + sep +
                     started + sep + ends + sep +
                     sellerId + sep + description + newline);
  
        // output to seller
        bwAuctionSeller.write(sellerId + sep +
                              sellerRating + sep +
                              sellerLocation + sep +
                              sellerCountry + newline);

        // get all Item categories and insert output to ItemCategory
        Element[] categoryElements = getElementsByTagNameNR(item, "Category");
        for (Element categoryElement : categoryElements) {
          String category = getElementText(categoryElement);

          // output to ItemCategory
          bwItemCategory.write(itemId + sep + category + newline);
        }
  
        // get all bids on this item
        Element[] bidElements = getElementsByTagNameNR(
          getElementByTagNameNR(item, "Bids"), "Bid");
        for (Element bid : bidElements) {
          // collect bidder information
          Element bidder = getElementByTagNameNR(bid, "Bidder");
          String bidderId = bidder.getAttribute("UserID");
          String bidderRating = bidder.getAttribute("Rating");
          String bidderLocation = getFieldText(bidder, "Location");
          String bidderCountry = getFieldText(bidder, "Country");

          // output to bidder
          bwAuctionBidder.write(bidderId + sep +
                                bidderRating + sep +
                                bidderLocation + sep +
                                bidderCountry + newline);
  
          String bidTime = formatTime(getFieldText(bid, "Time"));
          String amount  = formatDollar(getFieldText(bid, "Amount"));
  
          // output to Bid
          bwBid.write(itemId + sep + bidderId + sep +
                      bidTime + sep + amount + newline);
        }
      }
 
      bwItem.close();
      bwItemCategory.close();
      bwAuctionSeller.close();
      bwAuctionBidder.close();
      bwBid.close();
    }
    catch (IOException e) {
      e.printStackTrace();
    }
  }

  static String getFieldText(Element element, String field) {
    String result = "NULL";  // account for empty field casts

    // extract element text if not null
    Element fieldElement = getElementByTagNameNR(element, field);
    if (fieldElement != null) {
      result = getElementText(fieldElement);
    }

    return result;
  }
  
  public static void main (String[] args) {
    if (args.length == 0) {
      System.out.println("Usage: java MyParser [file] [file] ...");
      System.exit(1);
    }

    /* Initialize parser. */
    try {
      DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
      factory.setValidating(true);
      factory.setIgnoringElementContentWhitespace(true);      
      builder = factory.newDocumentBuilder();
      builder.setErrorHandler(new MyErrorHandler());
    }
    catch (FactoryConfigurationError e) {
      System.out.println("unable to get a document builder factory");
      System.exit(2);
    } 
    catch (ParserConfigurationException e) {
      System.out.println("parser was unable to be configured");
      System.exit(2);
    }

    /* Process all files listed on command line. */
    for (int i = 0; i < args.length; i++) {
      File currentFile = new File(args[i]);
      processFile(currentFile);
    }
  }
}
