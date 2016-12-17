\COPY DukeEvent(eventid, eventname, starttime, location, hostURL, timecreated) FROM 'data/scrape_events_DukeEvent.csv' DELIMITER ',' NULL '' CSV HEADER
\COPY DukeGroup(name, websiteURL) FROM 'data/scrape_events_DukeGroup.csv' DELIMITER ',' NULL '' CSV HEADER
\COPY DukeUser(netid, dateJoined, dateLastUpdated, password) FROM 'data/scrape_events_DukeUser.csv' DELIMITER ',' NULL '' CSV HEADER
\COPY Favorite(netid, groupname) FROM 'data/scrape_events_Favorite.csv' DELIMITER ',' NULL '' CSV HEADER
\COPY Hosting(eventid, groupname) FROM 'data/scrape_events_Hosting.csv' DELIMITER ',' NULL '' CSV HEADER
\COPY Attending(netid, eventid) FROM 'data/scrape_events_Attending.csv' DELIMITER ',' NULL '' CSV HEADER
CREATE INDEX EventTime ON DukeEvent(starttime);
CREATE INDEX HostGroup ON Hosting(groupname);
CREATE INDEX UserAttending on Attending(netid);
