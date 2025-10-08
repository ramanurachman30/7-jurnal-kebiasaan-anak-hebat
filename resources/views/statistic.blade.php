@extends('skeleton')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="d-flex align-items-center justify-content-center dashboard-static">
            <h1>Statistic From Google Analitycs</h1>
            <!-- Step 1: Create the containing elements. -->

            <section id="auth-button"></section>
            <section id="view-selector"></section>
            <section id="timeline"></section>

            <!-- Step 2: Load the library. -->
        </div>
    </div>
@endsection

@section('customjs')
    <!-- Step 2: Load the Google API Client Library -->
    <script src="https://apis.google.com/js/client.js"></script>

    <!-- Step 3: Add your Google Analytics View ID -->
    <script>
        // Replace 'YOUR_GOOGLE_ANALYTICS_VIEW_ID' with your actual View ID from Google Analytics.
        const VIEW_ID = '347513544';
    </script>

    <!-- Step 4: Initialize the Google API Client -->
    <script>
        function initClient() {
            gapi.client.init({
                'apiKey': 'AIzaSyDRxdZKONf9EpyGFl8rbP3vDK3JvLsmUqk',
                'clientId': '333493293137-5o4pd2tes0ohudo6ui0ptnp8dj26kods.apps.googleusercontent.com',
                'scope': 'https://www.googleapis.com/auth/analytics.readonly',
                'discoveryDocs': ['https://analyticsreporting.googleapis.com/$discovery/rest?version=v4'],
            }).then(function() {
                // On success, load the elements and set up event listeners.
                loadElements();
            }).catch(function(error) {
                console.log('Error initializing the client:', error);
            });
        }

        // Load the Google API Client Library
        gapi.load('client', initClient);
    </script>

    <!-- Step 5: Load and render the data -->
    <script>
        function loadElements() {
            // Load the authentication button
            gapi.analytics.auth.on('success', function(response) {
                document.getElementById('auth-button').style.display =
                    'none'; // Hide the authentication button after successful authorization.
                queryData();
            });
            gapi.analytics.auth.render({
                container: 'auth-button',
                onsuccess: queryData
            });

            // Load the view selector
            gapi.analytics.viewSelector.render({
                container: 'view-selector',
                id: VIEW_ID
            });

            // Load the timeline data
            function queryData() {
                gapi.client.analyticsreporting.reports.batchGet({
                    'reportRequests': [{
                        'viewId': VIEW_ID,
                        'dateRanges': [{
                            'startDate': '7daysAgo',
                            'endDate': 'today'
                        }],
                        'metrics': [{
                            'expression': 'ga:sessions'
                        }]
                    }]
                }).then(function(response) {
                    // Process and render the data to the 'timeline' section
                    renderTimeline(response.result.reports[0]);
                }).catch(function(error) {
                    console.log('Error querying data:', error);
                });
            }

            // Render the timeline data using Google Charts API
            function renderTimeline(report) {
                const data = report.data.rows[0].metrics[0].values[0];
                document.getElementById('timeline').innerHTML = 'Total Sessions: ' + data;
            }
        }
    </script>
@endsection
