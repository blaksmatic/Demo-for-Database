/**
 * Created by admin on 3/8/16.
 */

/**
 * Main controller that controlls the main page as well as the list page
 */
app.controller('mainController', ['$scope', '$http', 'socket', '$routeParams', function ($scope, $http, socket, $routeParams) {

    //test data
    $scope.errorData = "YesYes";
    $scope.Hisname = "My Name";

    //This is the filter given to the selection, such as assignment1.0, and so on.
    $scope.this_filter = $routeParams.filters;
    //console.log($scope.this_filter);
    //this is the first connection, and will receive all the data.
    socket.on("connect", function () {
        socket.emit('data_recevied_by_front', "received the first part of data");

    });

    //emit this signal and refresh the filters and filtering result.
    socket.emit("get_prof");
    socket.on("receive_prof", function (data) {
        socket.emit('data_recevied_by_front', "data_received");
        $scope.prof_all = data;
        $scope.prof_filter = man_filter($scope.prof_all, $scope.this_filter);
        //console.log(data);
        //$scope.prof_filter = man_filter(data, $scope.this_filter);
    });

    $scope.current_prof_name = "Default";
    $scope.current_prof_address = "sef ";
    $scope.current_prof_url = "dd ";
    $scope.current_prof_title = "dd";
    $scope.current_prof_page = "default";
    $scope.current_prof_phone = "111444";
    $scope.current_prof_img = "default";
    $scope.current_prof_email = "aaa@gmail.com";
    $scope.current_prof_area = "Killing";

    $scope.ADD_PROF = function () {
        var new_prof = {
            name: $scope.current_prof_name,
            img: $scope.current_prof_img,
            url: $scope.current_prof_url,
            title: $scope.current_prof_title,
            email: $scope.current_prof_email,
            phone: $scope.current_prof_phone,
            area: $scope.current_prof_area
        };
        socket.emit("add_prof", new_prof);
        $scope.prof_all.push(new_prof);
        socket.emit('update_prof', $scope.prof_all);
        $scope.prof_filter = man_filter($scope.prof_all, $scope.this_filter);
    };

    $scope.name_to_delete = "";
    $scope.DELETE = function () {
        for (var i = 0; i < $scope.prof_all.length; i++) {
            //console.log($scope.prof_all[i].name);

            if ($scope.prof_all[i].name === $scope.name_to_delete) {
                socket.emit("delete_prof", {name: $scope.prof_all[i].name, id: i});
                $scope.prof_all.splice(i, 1);
                socket.emit("update_prof", $scope.prof_all);
                $scope.prof_filter = man_filter($scope.prof_all, $scope.this_filter);
            }
        }
    };

    $scope.search = function () {
        $scope.prof_filter = man_filter($scope.prof_all, $scope.this_filter);
    }

}]);


function man_filter(assignment, filter) {
    var to_return = [];
    //console.log(assignment);
    for (element in assignment) {
        if (assignment[element].name.indexOf(filter) > -1) {
            to_return.push(assignment[element]);
            console.log(assignment[element].name);
        }
    }
    return to_return;
}


/**
 * This is the controller for the detail page.
 */
app.controller('detailController', ['$scope', '$http', 'socket', '$routeParams', function ($scope, $http, socket, $routeParams) {
    $scope.errorData = "YesYes";
    $scope.Hisname = "My Name";

    //from the web browser
    $scope.id = parseInt($routeParams.id);
    $scope.assignment = "Assignment1.0";

    //firtly get the data
    socket.on("connect", function () {
        socket.emit('data_recevied_by_front', "received the first part of data");

    });

    $scope.current_comment = "Some Comments?";


    //transmit back the comments
    socket.emit("get_prof");
    socket.on("receive_prof", function (data) {
        socket.emit('data_recevied_by_front', "data_received_prof");
        $scope.assignment_all = data;
        $scope.this_assignment = data[$scope.id];
        $scope.length = data.length;
    });

    //get the filter
    socket.emit("get_filter_word");
    socket.on("receive_filter_word", function (data) {
        $scope.filter_word = data;
    });

    //data binding.
    $scope.save_comments = function () {
        for (elements in $scope.filter_word) {

            console.log($scope.filter_word);
            elements = $scope.filter_word[elements];
            $scope.current_comment = $scope.current_comment.replace(elements["before"], elements["after"]);
        }

        if ($scope.current_comment.charAt(0) == "@")
            target = $scope.current_comment.charAt(1);
        else target = 0;

        var new_comment = {"comment": $scope.current_comment, "target": target};
        console.log(new_comment);

        $scope.this_assignment.comments.push(new_comment);
        $scope.assignment_all[$scope.id] = $scope.this_assignment;
        $scope.current_comment = " ";
        socket.emit('update_comments', $scope.assignment_all);
        socket.emit('update_database', $scope.assignment_all);

    }

    $scope.attri = "name";
    $scope.value = "5";
    $scope.modify = function () {
        if ($scope.attri === "name")
            $scope.this_assignment.name = $scope.value;
        else if ($scope.attri === "url")
            $scope.this_assignment.url = $scope.value;
        else if ($scope.attri === "title")
            $scope.this_assignment.title = $scope.value;
        else if ($scope.attri === "img")
            $scope.this_assignment.img = $scope.value;
        else if ($scope.attri === "area")
            $scope.this_assignment.area = $scope.value;
        else if ($scope.attri === "email")
            $scope.this_assignment.email = $scope.value;
        else if ($scope.attri === "addr")
            $scope.this_assignment.addr = $scope.value;
        else if ($scope.attri === "phone")
            $scope.this_assignment.phone = $scope.value;

        $scope.assignment_all[$scope.id] = $scope.this_assignment;
        socket.emit('update_prof', $scope.assignment_all);

    }

}]);
