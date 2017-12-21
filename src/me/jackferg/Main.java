package me.jackferg;

import java.util.ArrayList;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Main {

	public static void main(String[] args){
		for (String a : getRoute(args[0])){
			System.out.println(a);
		}
	}
	
	public static ArrayList<String> getRoute(String ip){
		return parser(tracert.runSystemCommand(ip));
	}
	
	public static ArrayList<String> parser(ArrayList<String> ips){
		ArrayList<String> returner = new ArrayList<String>();
		int count = 0;
		for (String ip : ips){
			String theIP = takeLine(ip);
			if (theIP != ""){
				count++;
				if (count > 2){
					returner.add(takeLine(ip));
				}
			}
		}
		return returner;
	}
	
	private static String takeLine(String line){
		String IPADDRESS_PATTERN = 
		        "(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)";

		Pattern pattern = Pattern.compile(IPADDRESS_PATTERN);
		Matcher matcher = pattern.matcher(line);
		if (matcher.find()) {
		    return matcher.group();
		} else{
		    return "";
		}
	}
	
}
