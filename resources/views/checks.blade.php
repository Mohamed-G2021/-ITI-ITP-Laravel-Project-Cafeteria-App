@extends('layouts.app')

@section('content')

<!--start container-->
<div class="container">
    <h2>Checks</h2>

    <!--start inputsinfo-->
    <div class="inputsinfo">

        <!--start date input-->
        <div class="dateinputs">
            <label for="start">Date From</label>
            <input type="date" id="start" name="startdate">

            <label for="end">Date To</label>
            <input type="date" id="end" name="enddate">
        </div>
        <!--end date input-->

        <!--start name input-->
        <div class="nameinputs my-5 w-50">
            <label for="name">Username</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <!--end name input-->

    </div>
    <!--end inputsinfo-->

    <!--start data-->
    <div class="data">

    <table class="table table-bordered border-primary">
            <thead>
                <tr>

                <th scope="col">Name</th>
                <th scope="col">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span id="showorderbody" class="h4">+</span> abdo tarek
                    </td>
                    <td>110</td>
                </tr>
            </tbody>
                <!--start user orders-->
                <tbody class="orderbody d-none">
                    <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">Amount</th>
                    </tr>

                    <tr>
                        <td>
                            <span id="showproductbody" class="h4">+</span> 2015/02/02 10:30 am
                        </td>
                        <td>60</td>
                    </tr>
                    <!--start products-->
                    <tr class="productbody d-none">
                        <td colspan="2">
                            <!--start show product-->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="productprice">
                                            <img src="{{asset('drink.png')}}" width="50px">
                                            <span class="price">5 LE</span>
                                        </div>

                                        <p>tea</p>
                                        <span>1</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="productprice">
                                            <img src="{{asset('drink.png')}}" width="50px">
                                            <span class="price">5 LE</span>
                                        </div>
                                        <p>tea</p>
                                        <span>1</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="productprice">
                                            <img src="{{asset('drink.png')}}" width="50px">
                                            <span class="price">5 LE</span>
                                        </div>
                                        <p>tea</p>
                                        <span>1</span>
                                    </div>
                                </div>
                            <!--end show product-->
                        </td>
                    </tr>
                    <!--end products-->
                </tbody>
            <!--end user orders-->

    </table>



    </div>
    <!--end data-->

</div>
<!--end container-->



@endsection




