package me.jackferg;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.ArrayList;

public class tracert {
	public static ArrayList<String> runSystemCommand(String ip) {
		
		String command;
		
		if (System.getProperty("os.name").equals("Windows 10")){
			command = "tracert " + ip;
		} else {
			command = "traceroute " + ip;
		}
		
		ArrayList<String> returner = new ArrayList<String>();
		try {
			Process p = Runtime.getRuntime().exec(command);
			BufferedReader InputStream = new BufferedReader(new InputStreamReader(p.getInputStream()));
			String s = " ";
			while ((s = InputStream.readLine()) != null) {
				returner.add(s);
				//System.out.println(s);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return returner;
	}	
}