<form action = 'TicketFilterBars/userfilterTicket.php' method='post'>
    <ul style = "list-style-type: none;margin: 0;padding: 0;overflow: hidden;background-color: #333;">
        <li class = "active-filter" style="float:left;display: block;color: white;text-align: center;padding: 22px 16px;text-decoration: none;align:left"><text>Filter</text></li>
        <li style="float:left;display: block;color: white;text-align: center;padding: 21px 16px;text-decoration: none"><input style = "border: 2px blue;border-radius: 4px;" placeholder = "ID" type = "text" id = "ticket-search-id" name = "ticketsearchid"></li>
        <li style="float:left;display: block;color: white;text-align: center;padding: 21px 16px;text-decoration: none"><input style = "border: 2px blue;border-radius: 4px;" placeholder = "Title" type = "text" id = "ticket-search-title" name = "ticketsearchtitle"></li>
        <li style="float:left;display: block;color: white;text-align: center;background-color: #333;padding: 15px 16px;text-decoration: none">
            <div class='dropdown text-centered'>
				<select class='btn btn-secondary dropdown-toggle' type='button' id='signup-gender' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' name='ticketsearchStatus'>
                <option class='dropdown-item' value="">Status </option>
                <option class='dropdown-item' value="CREATED">Created</option>
                <option class='dropdown-item' value = "OPEN">Open</option>
                <option class='dropdown-item' value = "CLOSED">Closed</option>
                <option class='dropdown-item' value = "CANCELED">Canceled</option>
                </select>
			</div>
        </li>
        <li style="float:right;display: block;color: white;text-align: center;padding: 15px 16px;text-decoration: none;"><input style = 'color:white; background-color: crimson' class = "btn" value = "Search" type = "submit"></li>
    </ul>
</form>
