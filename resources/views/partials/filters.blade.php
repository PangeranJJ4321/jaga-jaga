<form method="GET" action="{{ route('events.index') }}">
    <div class="filter-box">
        <div class="mb-3">
            <div class="filter-header" data-bs-toggle="collapse" data-bs-target="#keywordFilter" aria-expanded="true">
                Keyword
            </div>
            <div id="keywordFilter" class="collapse show filter-content">
                <input type="text" name="keyword" class="form-control" placeholder="Enter keyword" value="{{ request('keyword') }}">
            </div>
        </div>

        <div class="mb-3">
            <div class="filter-header" data-bs-toggle="collapse" data-bs-target="#categoryFilter" aria-expanded="true">
                Category
            </div>
            <div id="categoryFilter" class="collapse show filter-content">
                <select name="category" class="form-select" style="font-size: 16px">
                    <option value="" selected>All Categories</option>
                    <option value="Trip/Camp" {{ request('category') == 'Trip/Camp' ? 'selected' : '' }}>Trip / Camp</option>
                    <option value="Concert/Music" {{ request('category') == 'Concert/Music' ? 'selected' : '' }}>Concert / Music</option>
                    <option value="Sport/Fitness" {{ request('category') == 'Sport/Fitness' ? 'selected' : '' }}>Sport / Fitness</option>
                    <option value="Cinema" {{ request('category') == 'Cinema' ? 'selected' : '' }}>Cinema</option>
                    <option value="Museum/Monument" {{ request('category') == 'Museum/Monument' ? 'selected' : '' }}>Museum / Monument</option>
                    <option value="Recreation Park/Attraction" {{ request('category') == 'Recreation Park/Attraction' ? 'selected' : '' }}>Recreation Park / Attraction</option>
                    <option value="Theater" {{ request('category') == 'Theater' ? 'selected' : '' }}>Theater</option>
                    <option value="Restaurant/Gastronomy" {{ request('category') == 'Restaurant/Gastronomy' ? 'selected' : '' }}>Restaurant / Gastronomy</option>
                    <option value="Workshop/Training" {{ request('category') == 'Workshop/Training' ? 'selected' : '' }}>Workshop / Training</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <div class="filter-header" data-bs-toggle="collapse" data-bs-target="#locationFilter" aria-expanded="true">
                Location
            </div>
            <div id="locationFilter" class="collapse show filter-content">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="location" value="online" id="onlineEvents" {{ request('location') == 'Online' ? 'checked' : '' }}>
                    <label class="form-check-label" for="onlineEvents">Online</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="location" value="offline" id="offlineEvents" {{ request('location') == 'Offline' ? 'checked' : '' }}>
                    <label class="form-check-label" for="offlineEvents">Offline</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="filter-header" data-bs-toggle="collapse" data-bs-target="#dateFilter" aria-expanded="true">
                Date
            </div>
            <div id="dateFilter" class="collapse show filter-content">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="date" value="today" id="todayEvents" {{ request('date') == 'today' ? 'checked' : '' }}>
                    <label class="form-check-label" for="todayEvents">Today</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="date" value="tomorrow" id="tomorrowEvents" {{ request('date') == 'tomorrow' ? 'checked' : '' }}>
                    <label class="form-check-label" for="tomorrowEvents">Tomorrow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="date" value="this_week" id="thisWeekEvents" {{ request('date') == 'this_week' ? 'checked' : '' }}>
                    <label class="form-check-label" for="thisWeekEvents">This Week</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="date" value="next_week" id="nextWeekEvents" {{ request('date') == 'next_week' ? 'checked' : '' }}>
                    <label class="form-check-label" for="nextWeekEvents">Next Week</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="date" value="next_month" id="nextMonthEvents" {{ request('date') == 'next_month' ? 'checked' : '' }}>
                    <label class="form-check-label" for="nextMonthEvents">Next Month</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-2">
                <button type="reset" class="btn btn-danger w-100" style="font-size: 2rem; font-weight: 600;" onclick="clearFilters()">Clear</button>
            </div>
            <div class="col-6 mb-2">
                <button type="submit" class="btn w-100" style="background-color: #f77e1c; color: white; font-weight: 600; font-size: 2rem;">Apply</button>
            </div>
        </div>        
    </div>
</form>
