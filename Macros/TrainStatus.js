/* 
 * FILE IS USED WITH IMACROS TO INITIAL SCREEN CAPTURING FOR TRAIN STATUS
 * Requires : Dashborad with a table of routes 
 * imacros
 */

//get all the routes from dashboard table to javascript array
var routes  = new array();
routes = get_routes();
//loop through the routes
for(route in routes){
    //find trains page for each  route
    if( find_trains(route) ){
        //get trains data for each route
        var trains = get_train_list();
        //foreach of the train - get train availibility - save it to database 
        for(train in trains){
            var train_data = get_train_data(train);
            save_to_db(train_data,file_name);
            //to reset page to listing page
            find_trains(route);
        }
        //emulate user behaviour - after train 
        humanize('basic');
        
    }
    //emulate user behaviour - after route
    humanize('advance');
    
}

/*************---------------------------------- FUNCTION LIST -------------------------------------------------------------********/



