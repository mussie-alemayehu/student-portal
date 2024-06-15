$(document).ready(function () {

    // define the link id and the assciated content in a list of maps
    // the individual maps will hold the id of the anchor tags as 'link_id' and
    // the path to the php files containing the respective content as 'content'
    var navigation = [
        new Map([
            ['link_id', '#dashboard-link'],
            ['content', 'dashboard/dashboard.php'],
        ]),
        new Map([
            ['link_id', '#courses-link'],
            ['content', 'courses/courses.php'],
        ]),
        new Map([
            ['link_id', '#results-link'],
            ['content', 'results/results.php'],
        ]),
        new Map([
            ['link_id', '#registration-link'],
            ['content', 'registration/registration.php'],
        ]),
    ];

    // register click events for all the navigation items defined in the list
    for (let item of navigation) {
        $(item.get('link_id')).click(function (event) {
            event.preventDefault();
            $('.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#main-contents').load(item.get('content'));
        });
    }

    // register a click event for the logout link
    for (let item of navigation) {
        $(item.get('link_id')).click(function (event) {
            event.preventDefault();
            $('.selected').removeClass('selected');
            $(this).addClass('selected');

            $('#main-contents').load(item.get('content'));
        });
    }

    // register a click event for the logout link and implement the logout logic
    $('#logout-link').click(function (event) {
        event.preventDefault();
        $confirm = confirm("Are you sure you want to logout?");
        if ($confirm) {
            window.location.href = 'auth/logout.php';
            window.location.href = 'auth/index.php';
            exit();
        }
    });
});