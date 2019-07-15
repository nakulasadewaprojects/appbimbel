@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
			<div class="col-xl-12">   
				<div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_1">
                    <div class="m-portlet m-portlet--mobile">
                        <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                           Informasi Payment
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="white-box printableArea">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="pull-right text-right">
                                                <address>
                                                    <h3>To,</h3>
                                                    <h4 class="font-bold">Gaala & Sons,</h4>
                                                    <p class="text-muted m-l-30">E 104, Dharti-2,
                                                        <br/> Nr' Viswakarma Temple,
                                                        <br/> Talaja Road,
                                                        <br/> Bhavnagar - 364002</p>
                                                    <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> 23rd Jan 2017</p>
                                                    <p><b>Due Date :</b> <i class="fa fa-calendar"></i> 25th Jan 2017</p>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Description</th>
                                                            <th class="text-right">Quantity</th>
                                                            <th class="text-right">Unit Cost</th>
                                                            <th class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>Milk Powder</td>
                                                            <td class="text-right">2 </td>
                                                            <td class="text-right"> $24 </td>
                                                            <td class="text-right"> $48 </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">2</td>
                                                            <td>Air Conditioner</td>
                                                            <td class="text-right"> 3 </td>
                                                            <td class="text-right"> $500 </td>
                                                            <td class="text-right"> $1500 </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">3</td>
                                                            <td>RC Cars</td>
                                                            <td class="text-right"> 20 </td>
                                                            <td class="text-right"> %600 </td>
                                                            <td class="text-right"> $12000 </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">4</td>
                                                            <td>Down Coat</td>
                                                            <td class="text-right"> 60 </td>
                                                            <td class="text-right">$5 </td>
                                                            <td class="text-right"> $300 </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="pull-right m-t-30 text-right">
                                                <p>Sub - Total amount: $13,848</p>
                                                <p>vat (10%) : $138 </p>
                                                <hr>
                                                <h3><b>Total :</b> $13,986</h3> </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div class="text-right">
                                                <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                                                <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>             
                            </div>
                        </div> 
            </div>
        </div>
    </div>
</div>
@endsection