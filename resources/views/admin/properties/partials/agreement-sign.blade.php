<div class="header">
    <div class="property-nearby">
        <form action="{{ url('admin/agreement/sign-agreement') }}" method="POST" id="signAgreementForm">
            @csrf
            <div class="nearby-info mb-4">
                 {{--<span class="nearby-title mb-3 d-block text-success">
                    <i class="fas fa-car mr-2"></i><b class="title">Add Property Expenses</b> 
                </span>--}}
                <div>

                    <br />
                    <div data-repeater-item class="d-flex mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-line">
                                        <input type="checkbox" id="agrement_type_renew" name="agrement_type"
                                            value="renew_agreement" class="filled-in" value="1" />
                                        <label
                                            for="agrement_type_renew">{{ __('An online contract is an agreement that is drafted, signed and executed
                                                            electronically via the internet. Online contracts are designed to be read and signed without the need
                                                            for physical paper. Signing is done using eSignature technology, whereby a signature can be added to the
                                                            contract in a variety of different ways.') }}</label>
                                    </div>
                                </div>



                            </div>
                        </div><br />
                    </div>
                </div>
            </div>
            <div class="card-footer" align="left">
                <input type="submit" name="save_draft" value="Agree this contract" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
