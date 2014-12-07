import java.util.*;
import java.io.*;


import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

public class PreProcess{
    public static void main (String[] args)
    {
        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        int numEdges = 0;
        Set<String> set = new HashSet<String>();
        // since there is exception , use try
        try{
            DocumentBuilder builder = factory.newDocumentBuilder();
            Document document = builder.parse(ClassLoader.getSystemResourceAsStream("mining.edges.xml"));
            // data structure;
            Map<String,ArrayList<String>> map = new HashMap<String,ArrayList<String>>();
            // iterator Node stuff.
            document.getDocumentElement().normalize();
            NodeList nodeList = document.getDocumentElement().getElementsByTagName("eecs485_edge");
            System.out.println(nodeList.getLength());
            numEdges = nodeList.getLength();
            for(int i = 0 ; i <  nodeList.getLength(); i++)
            {
                Node node = nodeList.item(i);
                if(node.getNodeType()==Node.ELEMENT_NODE)
                {
                    Element NodeElement = (Element) node;
                    NodeList fromList = NodeElement.getElementsByTagName("eecs485_from");
                    Element fromElement = (Element) fromList.item(0);
                    NodeList textFNList = fromElement.getChildNodes();
                    // get the from value
                    String from = ((Node)textFNList.item(0)).getNodeValue().trim();
                    set.add(from);
                    //System.out.println("First Name : " + ((Node)textFNList.item(0)).getNodeValue().trim());
                    fromList = NodeElement.getElementsByTagName("eecs485_to");
                    fromElement = (Element) fromList.item(0);
                    textFNList = fromElement.getChildNodes();
                    // get the to value
                    //System.out.println("to:" + ((Node)textFNList.item(0)).getNodeValue().trim());
                    String to =((Node)textFNList.item(0)).getNodeValue().trim();
                    set.add(to);
                    if(!map.containsKey(from))
                    {
                        ArrayList<String> temp = new ArrayList<String>();
                        temp.add(to);
                        map.put(from,temp);
                    }
                    else
                    {
                        map.get(from).add(to);
                    }
                }
                
                    
                    
                
            }
            File file1 = new File("../proutput");
            if(!file1.exists())
            {
                file1.mkdirs();
            }
            // after reading in all the data , write them out to file
            File file2 = new File("../proutput/output");
            if(!file2.exists())
            {
                file2.createNewFile();
            }
            System.out.println(map.size());
            try{
                // write them out
                FileWriter fileWriter= new FileWriter(file2);
                fileWriter.write("*Vertices "+Integer.toString(set.size())+"\n");
                Iterator<String> itr = set.iterator();
                for(String i: set)
                {
                    fileWriter.write(i+" \"alabama\""+"\n");
                }
                fileWriter.write("*Arcs "+Integer.toString(numEdges)+"\n");
                itr = map.keySet().iterator();
                String tempKey ;
                ArrayList<String> tempList ;
                while(itr.hasNext())
                {
                    tempKey = itr.next();
                    tempList= map.get(tempKey);
                    for( int i = 0 ; i < tempList.size(); i ++)
                    {
                        fileWriter.write(tempKey+" "+tempList.get(i)+"\n");
                    }
                }
                fileWriter.close();
                
            }catch(IOException e){
                e.printStackTrace();

            }
            
        }catch(Exception e)
        {
            e.printStackTrace();
        }
      
    }
}
