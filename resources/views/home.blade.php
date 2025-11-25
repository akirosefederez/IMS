@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>

        @elseif(session('error'))
        <div class="alert alert-success" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        @endif
        <div class="card mb-5 border-primary">
            <div class="card-header bg-primary text-white" style="background-color: #166ccf;">
                <h3 class="mt-2">Dashboard</h3>
                <h6 class="card-subtitle mb-2 text-white font-weight-lighter">Item Count</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Categories
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM categories';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Brands
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM brands';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Inventory Items
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM products';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Check-ins
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM checkins';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="d-block d-sm-none">
                <div class="row mt-3">
                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Client Checkouts
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM order_items';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Item Returns
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM return_slips';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Borrowed Items
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM borrowers';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Purchase Returned Items
                            </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM purchase_returns';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Available Items </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM products WHERE status = "Available" ';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Low Stock Items </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM products WHERE status = "Low Stock" ';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-primary text-dark">
                            <div class="card-header bg-primary text-white">
                                Out of Stock Items </div>
                            <div class="card-body">
                                <h3 style="text-align: center">
                                    <span class="count">
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $dbname = 'ims_inventory1';
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $sql = 'SELECT count(id) AS total FROM products WHERE status = "Out of Stock" ';
                                        $result = mysqli_query($con, $sql);
                                        $values = mysqli_fetch_assoc($result);
                                        $num_rows = $values['total'];

                                        echo $num_rows;

                                        ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
