#!/usr/bin/env python
from lxml import html
import requests
import csv
import datetime
import re

if __name__ == "__main__":

	myevents = {} #dictionary where key = eventID and value is datetime, eventname, 
	index = 0
 
	page = requests.get('http://calendar.duke.edu/events/index?rows=1250#current')
	tree = html.fromstring(page.content)
	masterlst = tree.get_element_by_id('event_list') 

	for event in masterlst:

		if event.find_class("ongoing_event") != []: #avoid ongoing events
			continue
		
		index+=1
		myevents[index] = {}
		myevents[index]['date'] = event.attrib.values()[0] #get date of event
		
		for item in event:
			if item.tag == 'div':
				myevents[index]['time'] = item[0].text	#get time of event
			if item.tag == 'article':
				for spec in item:
					if spec.tag == 'header': 
						temp = spec[0][0].text
						temp = temp.replace(';','')
						temp = temp.replace('"','')
                                                temp=temp.replace("/","")
                                                temp=temp.replace(",","")
                                                temp=temp.replace('"',"")
                                                temp=temp.replace("\n", "")
						myevents[index]['name'] = temp	#get name of event
						myevents[index]['url'] = "calendar.duke.edu"+spec[0][0].attrib.values()[0] 	#get url info of event
					if spec.tag == 'dl':
						myevents[index]['location'] = ""	#get location of event
						for i in range(len(spec[4])): 
							if i < 1:
                                                                temp=spec[4][i].text.rstrip()
                                                                temp=temp.replace(";","")
                                                                temp=temp.replace("/","")
                                                             	temp=temp.replace(",","")
                                                                temp=temp.replace('"',"")
                                                                temp=temp.replace("\n", "")
                                                                 
								myevents[index]['location'] = temp	#get location of event
						for i in range(len(spec[1][0])): 
							myevents[index]['host'] = spec[1][0][i].text	#get sponsors of event
	
	###################################################
	months = ['January','February','March','April','May','June','July','August','September','October','November','December']
	for thing in myevents.keys():

		#clean up the date
		datelst = myevents[thing]['date'].split()
		month = datelst[1]
		year = datelst[3]
		for i in range(len(months)):
			if month == months[i]:
				month = str(i+1)
		day = ''
		if len(datelst[2]) == 2:
			day = datelst[2][0:1]
		else:
			day = datelst[2][0:2]
		
		myevents[thing]['date'] = month+'/'+day+'/'+year

		#clean up the time

		#print myevents[thing]['time'].split()
		timelst = myevents[thing]['time'].split()
		ntime = ''
		if timelst[1] == 'am':
			ntime = timelst[0]
		elif timelst[1] == 'pm':
			if timelst[0] > '12:59':
				if len(timelst[0]) == 4:
					temp = int(timelst[0][0:1])
					temp = temp+12
					ntime = str(temp)+timelst[0][1:]
				if len(timelst[0]) == 5:	
					temp = int(timelst[0][0:2])
					temp = temp+12
					ntime = str(temp)+timelst[0][2:]
			if timelst[0] >= '12:00' and timelst[0] <= '1:00':
				ntime = timelst[0]
		else:
			ntime = '00:01'
		myevents[thing]['time'] = ntime
	##################################################################			
	seenkeys = []	
	with open('../db-events/data/scrape_events_DukeEvent.csv', 'wb') as csv1:
    		mywriter = csv.writer(csv1, delimiter=',')
    		mywriter.writerow(['ID','Name','Start Time', 'Location','Host URL','Time Updated'])
		for key in myevents.keys():
			try:
				mywriter.writerow([key,myevents[key]['name'],myevents[key]['date']+" "+myevents[key]['time'],myevents[key]['location'],myevents[key]['url'],datetime.datetime.now()])
				seenkeys.append(key)
			except:
				pass
	csv1.close()

	with open('../db-events/data/scrape_events_DukeGroup.csv', 'wb') as csv2:
    		mywriter = csv.writer(csv2, delimiter=',')
    		mywriter.writerow(['Name','Website URL'])
		seen = []
		for key in myevents.keys():

			try:
				if myevents[key]['host'] in seen:
					continue
				else:
					mywriter.writerow([myevents[key]['host'],myevents[key]['url']])
					seen.append(myevents[key]['host'])
			except:
				pass
			
			

	csv2.close()

	with open('../db-events/data/scrape_events_Hosting.csv', 'wb') as csv3:
    		mywriter = csv.writer(csv3, delimiter=',')
    		mywriter.writerow(['Event ID','Group'])
		for key in myevents.keys():
			try:	
				if key in seenkeys:
					mywriter.writerow([key,myevents[key]['host']])
			except:
				pass

	csv3.close()

	
	
	
