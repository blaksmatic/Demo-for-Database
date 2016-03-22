/**
 * Created by admin on 3/16/16.
 */
//set up the server using express
var express = require('express');
app = express();

//require http and creat the server
var server = require('http').createServer(app);

//use socket to link the web
var io = require('socket.io')(server);

//use a built-in file reader
fs = require('fs');

//preparing paring the data
var parseString = require('xml2js').parseString;

//Preparing the log list and assignment list.
var log_list = [];
var assignment_list = [];

//preparing the mongoose
var mongoose = require('mongoose');

//serve the static directory
app.use(express.static(__dirname + '/public'));

//start mongo client
var MongoClient = require('mongodb').MongoClient;
var assert = require('assert');

// Connection URL
var url = 'mongodb://localhost:27017/portfolio';
mongoose.connect(url);

//mongoose schema for comment
var commentSchema = mongoose.Schema({
    comment: String,
    id: Number,
    target: Number
});

//mongoose schema for files
var fileSchema = mongoose.Schema({
    name: String,
    id: Number,
    revision: Number,
    author: String,
    Size: String,
    commit_history: Object,
    genre: Object,
    last_date: String,
    last_commit: String
});

var profSchema = mongoose.Schema({
    name: String,
    id: Number,
    address: String,
    url: String,
    title: String,
    page: String,
    phone: Number,
    img: String,
    email: String
});

//mongoose schema for word filter
var filterSchema = mongoose.Schema({
    word_before: String,
    word_after: String
});

//initialize schemas
var Comments = mongoose.model('Comments', commentSchema, "mongoose_storage");
var FileSystem = mongoose.model('FileSystem', fileSchema, "mongoose_storage_file");
var wordSchema = mongoose.model('wordSchema', filterSchema, "mongoose_storage_filter");
var Professors = mongoose.model('Professors', profSchema, "mongoose_storage_prof");

// Use connect method to connect to the Server
var database;
MongoClient.connect(url, function (err, db) {
    if (err) throw err;
    database = db;
});

//create filters
var filter_words = [];
filter_words.push(new Filter({before: "fuck", after: "ck"}));
filter_words.push(new Filter({before: "bad", after: "good"}));
filter_words.push(new Filter({before: "love", after: "hate"}));

/*
 var insertDocument = function (db) {
 db.collection('portfolio').insertOne(
 assignment_list, function (err, result) {
 assert.equal(err, null);
 console.log("Inserted document error.")
 }
 );
 };
 */
/**
 *
 * "addr": "GDC 3.510",
 "img": "https://www.cs.utexas.edu/sites/default/files/styles/thumbnail/public/legacy_files/faculty/photos/ballard-hr.jpg?itok=Tb0aRa5r",
 "area": "Artificial Intelligence, Data Mining, Machine Learning, Natural Computation",
 "url": "",
 "title": "Professor",
 "phone": "512 471 9750",
 "email": "dana@cs.utexas.edu",
 "name": "Dana H. Ballard"
 * @param info
 * @constructor
 */

/**
 * This function read data from files and parse them into javascripts.
 * It is asyncronized, so we need to pass a function into another function.
 */
prof_list = [];

function prepare_data(callback) {

    fs.readFile('./public/data/utaxas.json', function (err, data) {
        if (err) {
            return console.log(err);
        }
        //parse into json
        data = JSON.parse(data);

        var index = 0;
        for (var index = 0; index < data.length; index++) {
            prof = data[index];
            info = {
                name: prof["name"],
                area: prof.area,
                phone: prof.phone,
                email: prof.email,
                title: prof.title,
                url: prof.url,
                addr: prof.addr,
                img: prof.img,
                id: index
            };
            var entry = new Professor(info);
            prof_list.push(entry);
        }
    });
}

/*
 function processing_data() {
 var index = 0;
 console.log("Love and Hate");
 console.dir(assignment_list);
 console.log(assignment_list.length);
 for (index = 0; index < assignment_list.length; index++) {
 console.log(assignment_list[index]);
 }
 }
 */

/**
 * This function pre-processing the files and parse them into assignment_list
 * @param list_json the json file containning the list of SVN
 * @param log_json the json file containning the log of the SVN
 * @returns {{}} Return assignment_list
 */
function process_assignment(list_json, log_json) {

    var authur_name = "/yzeng19/";
    var output = {};
    //this is the dictionary that contains the words that I don't want in my list
    var dict = [".idea", ".tex", ".jar", "out/production", "1.2/html", "vendor/", ".git"];
    list_json = list_json.lists.list[0].entry;

    //loop1 get all the list variables
    loop1:
        for (var i = 0; i < list_json.length; i++) {
            var element = list_json[i];
            var name_to_check = element.name[0];
            loop2:
                for (var ind = 0; ind < dict.length; ind++) {
                    if (name_to_check.indexOf(dict[ind]) > -1)
                        continue loop1;
                }

            //the info package passing to make an object.
            var info = {
                kind: get_type(element.name[0]),
                name: element.name[0],
                genre: element.name[0].substring(0, 13),
                size: (element.$.kind == "file" ? element.size[0] : "undefined"),
                commit_revision: parseInt(element.commit[0].$.revision),
                commit_author: element.commit[0].author[0],
                commit_date: element.commit[0].date[0].split("T")[0],
                index: i
            };
            // console.log(element.name[0].substring(0, 13));

            var new_assignment = new File(info);
            output[i] = new File(info);
        }

    //console.log("ff");
    log_json = log_json.log.logentry;
    for (each_key in output) {

        //look for the log files that have the same name as this assignment
        var current_name = authur_name.concat(output[each_key].name).trim();

        for (var k = 0; k < log_json.length; k++) {

            //make another package and pack this log file
            element = log_json[k];
            info = {
                revision: element.$.revision,
                author: element.author[0],
                date: element.date[0].split("T")[0],
                msg: element.msg[0],
            };

            //give this log to assignment.
            temp_log = new Log(info);
            var path = element.paths[0].path;
            for (var num = 0; num < path.length; num++) {
                var temp_path = path[num]._.trim();
                //console.log(temp_path);
                if (temp_path.valueOf() == current_name.valueOf()) {
                    output[each_key].commit_history[info.revision] = temp_log;
                }
            }
        }
    }

    //console.dir(output);
    console.log(Object.keys(output).length);
    return output;
}

//prepare the data before the outside link has come in.
prepare_data();

function get_type(file_name) {
    if (file_name.indexOf("java") > -1) {
        return "Java";
    }
    else if (file_name.indexOf("rb") > -1) {
        return "Ruby";
    }
    else if (file_name.indexOf("png") > -1 || file_name.indexOf("jpg") > -1) {
        return "Picture";
    }
    else if (file_name.indexOf("html") > -1 || file_name.indexOf("php") > -1) {
        return "Web";
    }
    else if (file_name.indexOf("js") > -1 || file_name.indexOf("css") > -1) {
        return "Web Style";
    }
    else {
        return "File";
    }
}

//wait for the connection and connect the sources.
io.on("connection", function (socket) {

    console.log("Socket linked!");

    console.log("Start Parsing Data!");

    socket.emit("initial_data_send");

    //This is called when required to send all the data to the front end
    socket.on('refresh_data', function () {
        socket.emit('receive_refresh_list', assignment_list);
    });

    //This is called when checking whether the data is correctly transmitted
    socket.on('data_recevied_by_front', function (message) {
        console.log(message);
    });

    //This is called when updating the comments into the database.
    socket.on('update_comments', function (message) {
        assignment_list = message;
        for (var i = 0; i < assignment_list.length; i++) {
            var comm = assignment_list[i].comments;
            //use the mongoose databse and update my comments.
            for (var j = 0; j < comm.length; j++) {
                var new_comment = new Commments({
                    comment: comm[i].comment,
                    id: i,
                    target: comm[i].target
                });
                //save the comments
                new_comment.save(function (err) {
                    if (err) throw err;
                });
            }
        }
    });

    socket.on('get_prof', function (message) {
        socket.emit('receive_prof', prof_list);
    });

    socket.on('add_prof', function (data) {
        var new_prof = new Professors({
            name: data.name,
            id: data.id,
            address: data.address,
            url: data.url,
            title: data.title,
            page: data.page,
            phone: data.phone,
            img: data.img,
            email: data.email
        });
        //Professors.save();
        prof_list.push(data);
    });

    socket.on('delete_prof', function (data) {
        //Professors.findOneAndRemove({name: data.name});
        prof_list.slice(data.id, 1);

    });

    //This is called when required to store everything into database.
    socket.on('update_database', function (message) {
        assignment_list = message;
        for (var i = 0; i < assignment_list.length; i++) {
            var new_assignment = new FileSystem({
                name: assignment_list[i].name,
                id: assignment_list[i].id,
                revision: assignment_list[i].revision,
                author: assignment_list[i].author,
                Size: assignment_list[i].size,
                commit_history: assignment_list[i].commit_history,
                genre: assignment_list[i].genre,
                last_date: assignment_list[i].last_date,
                last_commit: assignment_list[i].name.last_commit

            });
            FileSystem.save(function (err) {
                if (err) throw err;
            });
        }
    });

    socket.on('update_prof', function (message) {
        prof_list = message;
    });

    socket.on('load_everything', function () {
        var new_list = [];
        var query = database.find({}, function (err, data) {

        });
        console.log(query);

        socket.emit('everything_here', new_list);
    });

    //This is called when asked to pass the filters.
    socket.on('get_filter_word', function () {
        socket.emit('receive_filter_word', filter_words);
    });

    //Storing the data into the databse.
    for (element in filter_words) {
        element = filter_words[element];
        var new_filter = new wordSchema({
            before: element["before"],
            after: element["after"]
        });
        new_filter.save(function (err) {
            if (err) throw err;
        });
    }
});

//This is the log object.
function Log(info) {
    this.revision_number = info.revision;
    this.author = info.author;
    this.date = info.date;
    this.message = info.msg;
}

//This is the file object
function File(info) {
    this.name = info.name;
    this.kind = info.kind;
    this.genre = info.genre;
    this.size = info.size;
    this.last_revision = info.commit_revision;
    this.author = info.commit_author;
    this.last_date = info.commit_date;
    this.id = info.index;
    this.commit_history = {};
    this.comments = [];
}

function Professor(info) {
    this.name = info.name;
    this.img = info.img;
    this.url = info.url;
    this.title = info.title;
    this.email = info.email;
    this.phone = info.phone;
    this.area = info.area;
    this.id = info.id;

}

//This is the filter obejct.
function Filter(info) {
    this.before = info.before;
    this.after = info.after;
}

server.listen(3000);
console.log("Server listen to 3000");