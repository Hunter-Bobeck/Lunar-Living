<form action = "#">
                        <ul style = "list-style-type: none;margin: 0;padding: 0;overflow: hidden;background-color: #333;align-text:center">
                            <li class = "active-filter" style="float:left;display: block;color: white;text-align: center;padding: 20px 16px;text-decoration: none;align:left"><text>Filter</text></li>
                            <li style="float:left;display: block;color: white;text-align: center;padding: 20px 16px;text-decoration: none"><input placeholder = "ID" type = "text" id = "ticket-search-id" name = "ticketsearchid"></li>
                            <li style="float:left;display: block;color: white;text-align: center;padding: 20px 16px;text-decoration: none"><input placeholder = "Title" type = "text" id = "ticket-search-title" name = "ticketsearchtitle"></li>
                            <li style="float:left;display: block;color: white;text-align: center;padding: 20px 16px;text-decoration: none">
                            <div class='dropdown text-centered'>
								<select class='btn btn-secondary dropdown-toggle' type='button' id='signup-gender' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' name='signupGender'>
                                    <option class='dropdown-item' value="Gender">Status </option>
                                    <option class='dropdown-item' value="Male">Created</option>
									<option class='dropdown-item' value = "Female">Open</option>
                                    <option class='dropdown-item' value = "other">Closed</option>
                                    <option class='dropdown-item' value = "other">Cancelled</option>
                                </select>
							</div>
                            </li>
                            <li style="float:right;display: block;color: white;text-align: center;padding: 20px 16px;text-decoration: none"><input value = "Search" type = "submit"></li>

                        </ul>
                        </form>