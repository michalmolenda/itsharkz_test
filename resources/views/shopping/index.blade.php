@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4>Shopping list</h4>
        </div>
        <div class="col-lg-6 text-right">
            <input type="text" placeholder="List name" id="itemName" class="form-control" style="display: inline-block; width: 250px;">
            <a href="#" class="btn btn-primary" id="addNewItem" style="display: inline-block">
                Add item
            </a>
        </div>
    </div><br>

    <ul id="shoppingList"></ul>
@endsection

@section('scripts')
    <script>
        let ShoppingList = {
            __shoppingList : [],

            // Triggers
            Initialize : function() {
                console.log(localStorage.getItem("shoppingList"));

                ShoppingList.__shoppingList = JSON.parse(localStorage.getItem("shoppingList"));

                ShoppingList.List.Generate();

                document.getElementById('addNewItem').onclick = function() {
                    var itemName = document.getElementById('itemName').value;

                    if(itemName.length === 0) {
                        document.getElementById('itemName').style.borderColor = 'red';
                    } else {
                        document.getElementById('itemName').style.borderColor = '#dee2e6';
                        document.getElementById('itemName').value = '';

                        // Remove non-ascii characters
                        itemName = itemName.normalize('NFD')
                            .replace(/[\u0300-\u036f]/g, '')
                            .replace(/(^-+|-+$)/g, '');

                        ShoppingList.List.Create(itemName);
                    }
                }
            },

            List : {
                // Create list
                Create : function(name) {
                    let rowId = ShoppingList.List.FindByName(name);

                    if(rowId !== null) {
                        // Increase if exists

                        ShoppingList.List.Quantity.Increase(rowId);
                    } else {
                        // Create if not

                        ShoppingList.__shoppingList.push({
                            'name': name,
                            'quantity': 1
                        });
                    }

                    ShoppingList.List.Generate();
                },

                // Find row by name
                FindByName : function(name) {
                    for(let rowId in ShoppingList.__shoppingList) {
                        let row = ShoppingList.__shoppingList[rowId];

                        if(row !== null) {
                            if(name === row.name) {
                                return rowId;
                            }
                        }
                    }

                    return null;
                },

                // Generate HTML code
                Generate : function() {
                    let html = '<ul>';

                    let __shoppingList = ShoppingList.__shoppingList.sort((secondItem, firstItem) => firstItem.quantity - secondItem.quantity);

                    for(let rowId in __shoppingList) {
                        let row = __shoppingList[rowId];

                        if(row !== null) {
                            html += '<li>' +
                                '<span>' + row.name + '</span>' +
                                ' - ' +
                                '<span>quantity: ' + row.quantity + '</span>' +
                                '<button onclick="ShoppingList.List.Quantity.Increase(' + rowId + ');">+</button>' +
                                '<button onclick="ShoppingList.List.Quantity.Decrease(' + rowId + ');">-</button>' +
                                '</li>';
                        }
                    }

                    html += '</ul>';

                    document.getElementById('shoppingList').innerHTML = html;

                    // Save in local Storage
                    localStorage.setItem("shoppingList", JSON.stringify(ShoppingList.__shoppingList));
                },

                Quantity : {
                    // Increase quantity
                    Increase : function(rowId) {
                        ShoppingList.List.Quantity.Change(rowId, '+');
                    },

                    // Decrease quantity
                    Decrease : function(rowId) {
                        ShoppingList.List.Quantity.Change(rowId, '-');
                    },

                    // Change quantity
                    Change : function(rowId, type) {
                        if(typeof ShoppingList.__shoppingList[rowId] !== 'undefined') {
                            switch(type) {
                                case '+':
                                    ++ShoppingList.__shoppingList[rowId].quantity;
                                    break;
                                case '-':
                                    if(ShoppingList.__shoppingList[rowId].quantity > 1) {
                                        --ShoppingList.__shoppingList[rowId].quantity;
                                    } else {
                                        delete ShoppingList.__shoppingList[rowId];

                                        // Remove null rows
                                        ShoppingList.__shoppingList = ShoppingList.__shoppingList.filter(function (el) {
                                            return el != null;
                                        });
                                    }

                                    break;
                            }
                        }

                        ShoppingList.List.Generate();
                    }
                }
            }
        };

        // Initialize with some data
        ShoppingList.Initialize();
    </script>
@endsection
