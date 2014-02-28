/* 
 * FILE IS USED WITH IMACROS TO INITIAL SCREEN CAPTURING FOR TRAIN STATUS
 * Requires : Dashborad with a table of routes 
 * imacros
 */


//init
//init();
//get all the routes from dashboard table to javascript array

        ROW_START_TRAIN_LISTING = 3;  //row in the table where train data starts in train listing page 
        FILE_NAME = 'Train_Status_'+get_time_stamp()+'.xml';        
        TRAIN_LISTING_URL = 'www.indianrail.gov.in/dont_Know_Station_Code.html';
//load dashboard 
load_url ('http://hexatrip.com/index.php?r=dashboard');
iimPlay('CODE: PAUSE');
var routes = new Array();
routes = get_routes();

//loop through the routes
for (var i = 1; i <=routes.length; i++) {  //i=1 to omit header of table
    var route = routes[i];
    //find trains page for each  route      
    find_trains(route);
        //get trains data for each route
        var trains = get_train_list();
        //foreach of the train - get train availibility - save it to database 
        for (var j = 0; j < trains.length; j++) {
            var start_from = j + ROW_START_TRAIN_LISTING;  //train listing starts from the 3rd row in train listing table
            var train = trains[j];
            var train_data = get_train_data(start_from,train,route);
             find_trains(route);
           // save_to_db(train_data, FILE_NAME);
             iimDisplay('Finished  route no:' +i+' - Train no :' +j);
             //humanize('medium');
          
        }
        //emulate user behaviour - after train 
       


    //emulate user behaviour - after route
    humanize('advance');
    
 
}
//complete
iimDisplay('Finished  Extracting data , file at ' +FILE_NAME);

/*************---------------------------------- FUNCTION LIST -------------------------------------------------------------********/


/**
 * 
 * @returns array of routes with location codes
 */
function get_routes() {
    var routes = '';
    var routes_array = new Array();
    iimDisplay("Getting Routes");
    iimPlay("CODE:TAG POS=1 TYPE=TABLE ATTR=CLASS:table  EXTRACT=TXT");
    if (iimGetLastExtract() != '#EANF#') {
        routes = iimGetLastExtract();
    }
    //convert  string to array   
    routes_array = csv_to_array(routes);
//    routes_array  = routes.csvToArray({ head:true });
    return routes_array;
}
/**
 * 
 * @returns loads the page with train listing 
 */
function find_trains(route) {
    if (!route) {
        return false;
    }
    //extract route details 
    var from_code = route[3];
    var to_code = route[6];
    var url = TRAIN_LISTING_URL//'www.indianrail.gov.in/dont_Know_Station_Code.html';

    //load route page 
    load_url(url);
    iimSet("FROM", from_code);
    iimSet("TO", to_code);
    var macro = "CODE:";
//    macro += "TAB CLOSE  \n";
//    macro += "TAB OPEN  \n";
//    macro += "TAB T=2  \n";    
    macro += 'EVENT TYPE=CLICK SELECTOR="#txtStationFrom" BUTTON=0  \n';
    macro += 'EVENTS TYPE=KEYPRESS SELECTOR="#txtStationFrom" CHARS={{FROM}}  \n';
    macro += 'EVENT TYPE=CLICK SELECTOR="HTML>BODY>DIV:nth-of-type(9)>UL>LI:nth-of-type(1)>STRONG" BUTTON=0  \n';
    macro += 'EVENT TYPE=CLICK SELECTOR="#txtStationTo" BUTTON=0  \n';
    macro += 'EVENTS TYPE=KEYPRESS SELECTOR="#txtStationTo" CHARS={{TO}}  \n';
    macro += 'EVENT TYPE=CLICK SELECTOR="HTML>BODY>DIV:nth-of-type(10)>UL>LI" BUTTON=0  \n';
     macro += 'TAG POS=1 TYPE=SELECT FORM=ID:formId ATTR=NAME:lccp_classopt CONTENT=%ZZ  \n';
    macro += 'EVENT TYPE=CLICK SELECTOR="#formId>TABLE>TBODY>TR>TD>TABLE>TBODY>TR:nth-of-type(2)>TD:nth-of-type(2)>TABLE>TBODY>TR>TD>TABLE>TBODY>TR:nth-of-type(24)>TD:nth-of-type(2)>INPUT" BUTTON=0  \n';

    iimDisplay("Finding Trains for the route");
    retcode = iimPlay(macro);


    if (retcode < 0) {              // an error has occured
        errtext = iimGetLastError();
        //alert (errtext);
        return false;
    }
    
    //everything is all right
    return true;

}

/**
 * 
 * @returns array of trains with train id and name etc 
 */
function get_train_list() {
    var retcode = 1;
    var train_list = '';
    var train_list_array = new Array();
    var count = ROW_START_TRAIN_LISTING;  // 3rd row in table is the data row
    var base_xpath = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td[1]/table/tbody/tr/td/table[1]/tbody/tr[6]/td/table[2]';  //xpath selector for main train table
    iimDisplay("Copying Train Lists");
    while (1) {
        var xpath = base_xpath + '/tbody/tr[' + count + ']/td[1]';
        iimSet("XPATH", xpath);
        retcode = iimPlay('CODE:TAG XPATH="{{XPATH}}"   EXTRACT=TXT');
        if (iimGetLastExtract() == '#EANF#' || (retcode < 0)) {
            break;
        }
        train_list_array.push(iimGetLastExtract());
        count++;
    }

    if (retcode < 0) {              // an error has occured
        errtext = iimGetLastError();
        //alert (errtext);
        return false;
    }



    //convert  string to array   
//    train_list_array = csv_to_array(train_list);  
//    routes_array  = routes.csvToArray({ head:true });
    return train_list_array;
}

/**
 * 
 * @returns array data (availibility/status/date) for train in the route
 */
function get_train_data(start_from,train,route) {
    var count = start_from;  // train^th row in table is the data row
    var base_xpath = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td[1]/table/tbody/tr/td/table[1]/tbody/tr[6]/td/table[2]';  //xpath selector for main train table
      iimDisplay('currently on route:' +route+' - Train  :' +train);
    var xpath_radio = base_xpath + '/tbody/tr[' + count + ']/td[1]/input';
    var xpath_input = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td[1]/table/tbody/tr/td/table[1]/tbody/tr[6]/td/table[1]/tbody/tr[4]/td/input[1]';
    iimSet("XPATH_RADIO", xpath_radio);
    iimSet("XPATH_INPUT", xpath_input);
    var macro = 'CODE:TAG XPATH="{{XPATH_RADIO}}" \n';   //select the radio button
    macro += 'ONDIALOG POS=1 BUTTON=OK CONTENT= \n';       //handle popup
    macro += 'TAG XPATH={{XPATH_INPUT}}';       //click the get availability button
    retcode = iimPlay(macro);
    if (retcode < 0) {              // an error has occured
        errtext = iimGetLastError();
        //alert (errtext);
        return false;
    }
    //train availibility page is displayed - extract next 2 months data 
    //humanize('basic');
    get_train_avail_data_new(train,route);
//    alert(train_avail_data.length)
    




}
function get_train_avail_data_new(train,route) {
    var avail_array= new Array();
    var result= new Array();
    var count = 0;
    while (1) {
        
        //extract train details 
        var train_table_xpath = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[4]/td/table/tbody/tr[2]';
        var train_number_xpath  = train_table_xpath+'/td[1]';
        var train_name_xpath  = train_table_xpath+'/td[2]';
        iimSet('XPATH_TRAIN_NUMBER',train_number_xpath);
        iimPlay('CODE: TAG XPATH={{XPATH_TRAIN_NUMBER}} EXTRACT=TXT');
        var train_number =  iimGetLastExtract();
        
         iimSet('XPATH_TRAIN_NAME',train_name_xpath);
        iimPlay('CODE: TAG XPATH={{XPATH_TRAIN_NAME}}  EXTRACT=TXT');
        var train_name =  iimGetLastExtract();
        
//        
        var avail_table_xpath = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[8]/td/table';
        iimSet("XPATH_TABLE", avail_table_xpath);
        var macro = 'CODE: ';
//        macro += 'TAG XPATH={{XPATH_TABLE}} EXTRACT=TXT';
macro+= 'TAG POS=25 TYPE=TABLE ATTR=CLASS:* EXTRACT=TXT';
        retcode = iimPlay(macro);
        if (retcode < 0) {              // an error has occured
            errtext = iimGetLastError();
            //alert (errtext);
            return false;
        }

        if (iimGetLastExtract() != '#EANF#') {
           var  avail = iimGetLastExtract();
        }
        
        //save to xml string 
       var from_code = route[1];   //from code in dashboard alert table
        var to_code = route[4];
        var route_id  = from_code+'-'+to_code;
       var xml = '';
       xml+='<route>';
       xml+='<id>'+  route_id   +'</id>';
       xml+='<train_number>'+  train_number   +'</train_number>';
        xml+='<train_name>'+  train_name   +'</train_name>';
       xml+='<data>'+  avail   +'</data>';
       xml+='</route>';
       
       save_to_db(xml, FILE_NAME);
       iimPlay("CODE:TAG POS=1 TYPE=INPUT:SUBMIT ATTR=value:Get<SP>Next<SP>6<SP>Days<SP>Availability EXTRACT=TXT");
        var next_button_text = iimGetLastExtract();
        if (next_button_text == '#EANF#') {
            break;
        }
       humanize('basic');
//       break;
        iimPlay("CODE:TAG POS=1 TYPE=INPUT:SUBMIT ATTR=value:Get<SP>Next<SP>6<SP>Days<SP>Availability");
        count++;
    }
    return result;

}

function get_train_avail_data() {
    //keep extracting table data till next available button is no more = 2 month
    var avail_array= new Array();
    var result= new Array();
    var count = 0;
    while (1) {
        
        //extract train details 
        var train_table_xpath = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[4]/td/table/tbody/tr[2]';
        var train_number_xpath  = train_table_xpath+'/td[1]';
        var train_name_xpath  = train_table_xpath+'/td[2]';
        iimSet('XPATH_TRAIN_NUMBER',train_number_xpath);
        iimPlay('CODE: TAG XPATH={{XPATH_TRAIN_NUMBER}} EXTRACT=TXT');
        var train_number =  iimGetLastExtract();
        
         iimSet('XPATH_TRAIN_NAME',train_name_xpath);
        iimPlay('CODE: TAG XPATH={{XPATH_TRAIN_NAME}}  EXTRACT=TXT');
        var train_name =  iimGetLastExtract();
        
//        
        var avail_table_xpath = '/html/body/table/tbody/tr/td/table/tbody/tr[1]/td/table/tbody/tr[3]/td/table/tbody/tr/td/table/tbody/tr/td[2]/table/tbody/tr[2]/td/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[8]/td/table';
        iimSet("XPATH_TABLE", avail_table_xpath);
        var macro = 'CODE: ';
//        macro += 'TAG XPATH={{XPATH_TABLE}} EXTRACT=TXT';
macro+= 'TAG POS=25 TYPE=TABLE ATTR=CLASS:* EXTRACT=TXT';
        retcode = iimPlay(macro);
        if (retcode < 0) {              // an error has occured
            errtext = iimGetLastError();
            //alert (errtext);
            return false;
        }

        if (iimGetLastExtract() != '#EANF#') {
           var  avail = iimGetLastExtract();
        }
        //convert  string to array   
        var avail_array = new Array();
        avail_array = (csv_to_array(avail)); 
//        result.push(avail_array);
        //merge array for final insertion to db
        result[count]  = new Array();        
        for(j=0;j<avail_array.length;j++){
            
            result[count][j] = new Array();
                        
            for(k=0;k<avail_array[j].length;k++){
                result[count][j][k] = avail_array[j][k]
                
//                //alert (avail_array[j])
            }
            result[count][j].push(train_number);
            result[count][j].push(train_name);
            
             
        }
        //add train number etc 
       
        save_to_db(result[count], FILE_NAME);
        
//        var next_button = iimPlay("CODE:TAG POS=1 TYPE=INPUT:SUBMIT ATTR=value:Get<SP>Next<SP>6<SP>Days<SP>Availability EXTRACT=TXT");
        var next_button_text = iimGetLastExtract();
        if (next_button_text == '#EANF#') {
            break;
        }
       break;
        iimPlay("CODE:TAG POS=1 TYPE=INPUT:SUBMIT ATTR=value:Get<SP>Next<SP>6<SP>Days<SP>Availability");
        count++;
    }
    
    //alert (result[0][0])
    //alert (result[0][1])
    //alert (result[0][2])
    return result;



}

/**
 * 
 * @returns Saves the supplied data to file in imacros 
 */
function save_to_db(data, file_name) {

var retcode;      
       //check for null values - 
//       alert (data[i])
       if(data){    //remove records which have empty first value //remove first record too - header row
//            var data_row = data[i].join(',');
        iimSet("FILE_NAME",file_name);
        iimSet("DATA_ROW",data);
        macro = "CODE:SET !EXTRACT {{DATA_ROW}}  \n";
        macro += "SAVEAS TYPE=EXTRACT FOLDER=* FILE={{FILE_NAME}}";
        iimPlay(macro);
        //retcode = iimPlay("code: set !EXTRACT {{DATA}}\n SAVEAS TYPE=EXTRACT FOLDER=* FILE={{FILE_NAME}}");
        if (retcode < 0) {              // an error has occured
                    errtext = iimGetLastError();
                    //alert (errtext);
                    return false;
                } 

       }
        
        return true;

}
/**
 * 
 * @returns Emulates a average user behaviour( IP change, cookiee clear , random wait) 
 */
function humanize(type) {
    
    if (type = 'basic') {
        //perform basic operations
//        alert('basic wait');
        var basic_wait  = getRandomInt (1, 10);
        iimPlay('CODE:  WAIT SECONDS='+basic_wait);
    }
    if (type = 'medium') {
        //perform basic operations
//        alert('medium wait');
         var medium_wait  = getRandomInt (10, 35);
        iimPlay('CODE:  WAIT SECONDS='+medium_wait);
    }
    if (type == 'advance') {
        //perform advacne operation
//        alert('advance  wait');
        var advance_wait  = getRandomInt (40, 90);
        iimPlay('CODE:  WAIT SECONDS='+advance_wait);
        iimPlay('CODE:  CLEAR'); //clear cookies and browser cache
    }
}

/**
 * Returns a random integer between min and max
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 * Loads a url anonymously using online proxy
 */
function load_url (url) {
    if(!url){
        return false;
    }
    var macro ='CODE:';
    macro += 'URL GOTO='+url+'  \n';
//    macro += 'TAG POS=1 TYPE=INPUT:TEXT FORM=ACTION:doproxy.jsp ATTR=NAME:page CONTENT='+url+'  \n';
//    macro += 'TAG POS=1 TYPE=INPUT:IMAGE FORM=ACTION:doproxy.jsp ATTR=SRC:http://www.kproxy.com/img/surf_btn.png  \n';
    var retcode  = iimPlay(macro);
    if (retcode < 0) {              // an error has occured
                    errtext = iimGetLastError();
                    //alert (errtext);
                    return false;
                } 

       return true;
}

/**
 * 
 * @returns Converts csv data to array [ "","","",""   \r\n    "","",""  ]
 */
function csv_to_array(csv_string) {
    //alert (csv_string)
    var result = new Array();
    var re = /\r\n|\n\r|\n|\r/g;
    var lines = csv_string.replace(re, "\n").split("\n"); //split miltilines using new line seperator
//var lines=csv_string.split("\n");
var count  = lines.length;
    for (var i = 0; i < count ; i++) {
        var temp_line = lines[i].split(',');  //split fields 
        for (var j = 0; j < temp_line.length; j++) {
            temp_line[j] = temp_line[j].replace(/"/g, ""); //remove extra "" from fields
        }
        result.push(temp_line);


    }
//now cleanup extra "" from entries
    return result;
}


function get_time_stamp(){
    var currentdate = new Date(); 
var timestamp = currentdate.getDate() + "."
                + (currentdate.getMonth()+1)  + "." 
                + currentdate.getFullYear() + "_"  
                + currentdate.getHours() + "."  
                + currentdate.getMinutes() + "." 
                + currentdate.getSeconds();
        
        return timestamp;
}


/*
 * csvToArray v2.1 (Unminifiled for development)
 *
 * For documentation visit:
 * http://code.google.com/p/csv-to-array/
 *
 */

function init() {

    String.prototype.csvToArray = function(o) {
        var od = {
            'fSep': ',',
            'rSep': '\r\n',
            'quot': '"',
            'head': false,
            'trim': false
        }
        if (o) {
            for (var i in od) {
                if (!o[i])
                    o[i] = od[i];
            }
        } else {
            o = od;
        }
        var a = [
            ['']
        ];
        for (var r = f = p = q = 0; p < this.length; p++) {
            switch (c = this.charAt(p)) {
                case o.quot:
                    if (q && this.charAt(p + 1) == o.quot) {
                        a[r][f] += o.quot;
                        ++p;
                    } else {
                        q ^= 1;
                    }
                    break;
                case o.fSep:
                    if (!q) {
                        if (o.trim) {
                            a[r][f] = a[r][f].replace(/^\s\s*/, '').replace(/\s\s*$/, '');
                        }
                        a[r][++f] = '';
                    } else {
                        a[r][f] += c;
                    }
                    break;
                case o.rSep.charAt(0):
                    if (!q && (!o.rSep.charAt(1) || (o.rSep.charAt(1) && o.rSep.charAt(1) == this.charAt(p + 1)))) {
                        if (o.trim) {
                            a[r][f] = a[r][f].replace(/^\s\s*/, '').replace(/\s\s*$/, '');
                        }
                        a[++r] = [''];
                        a[r][f = 0] = '';
                        if (o.rSep.charAt(1)) {
                            ++p;
                        }
                    } else {
                        a[r][f] += c;
                    }
                    break;
                default:
                    a[r][f] += c;
            }
        }
        if (o.head) {
            a.shift()
        }
        if (a[a.length - 1].length < a[0].length) {
            a.pop()
        }
        return a;
    }
}
/**
 * Convert data in CSV (comma separated value) format to a javascript array.
 *
 * Values are separated by a comma, or by a custom one character delimeter.
 * Rows are separated by a new-line character.
 *
 * Leading and trailing spaces and tabs are ignored.
 * Values may optionally be enclosed by double quotes.
 * Values containing a special character (comma's, double-quotes, or new-lines)
 *   must be enclosed by double-quotes.
 * Embedded double-quotes must be represented by a pair of consecutive 
 * double-quotes.
 *
 * Example usage:
 *   var csv = '"x", "y", "z"\n12.3, 2.3, 8.7\n4.5, 1.2, -5.6\n';
 *   var array = csv2array(csv);
 *  
 * Author: Jos de Jong, 2010
 * 
 * @param {string} data      The data in CSV format.
 * @param {string} delimeter [optional] a custom delimeter. Comma ',' by default
 *                           The Delimeter must be a single character.
 * @return {Array} array     A two dimensional array containing the data
 * @throw {String} error     The method throws an error when there is an
 *                           error in the provided data.
 */
function csv2array(data, delimeter) {
    // Retrieve the delimeter
    if (delimeter == undefined)
        delimeter = ',';
    if (delimeter && delimeter.length > 1)
        delimeter = ',';

    // initialize variables
    var newline = '\n';
    var eof = '';
    var i = 0;
    var c = data.charAt(i);
    var row = 0;
    var col = 0;
    var array = new Array();

    while (c != eof) {
        // skip whitespaces
        while (c == ' ' || c == '\t' || c == '\r') {
            c = data.charAt(++i); // read next char
        }

        // get value
        var value = "";
        if (c == '\"') {
            // value enclosed by double-quotes
            c = data.charAt(++i);

            do {
                if (c != '\"') {
                    // read a regular character and go to the next character
                    value += c;
                    c = data.charAt(++i);
                }

                if (c == '\"') {
                    // check for escaped double-quote
                    var cnext = data.charAt(i + 1);
                    if (cnext == '\"') {
                        // this is an escaped double-quote. 
                        // Add a double-quote to the value, and move two characters ahead.
                        value += '\"';
                        i += 2;
                        c = data.charAt(i);
                    }
                }
            }
            while (c != eof && c != '\"');

            if (c == eof) {
                throw "Unexpected end of data, double-quote expected";
            }

            c = data.charAt(++i);
        }
        else {
            // value without quotes
            while (c != eof && c != delimeter && c != newline && c != ' ' && c != '\t' && c != '\r') {
                value += c;
                c = data.charAt(++i);
            }
        }

        // add the value to the array
        if (array.length <= row)
            array.push(new Array());
        array[row].push(value);

        // skip whitespaces
        while (c == ' ' || c == '\t' || c == '\r') {
            c = data.charAt(++i);
        }

        // go to the next row or column
        if (c == delimeter) {
            // to the next column
            col++;
        }
        else if (c == newline) {
            // to the next row
            col = 0;
            row++;
        }
        else if (c != eof) {
            // unexpected character
            throw "Delimiter expected after character " + i;
        }

        // go to the next character
        c = data.charAt(++i);
    }

    return array;
}