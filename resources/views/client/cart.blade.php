@extends('layouts.client')
@section('content')
    <!-- Body Container -->
    <div id="page-content">
        <!--Page Header-->
        <div class="page-header text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                        <div class="page-title">
                            <h1>Your Shopping Cart Style1</h1>
                        </div>
                        <!--Breadcrumbs-->
                        <div class="breadcrumbs"><a href="{{ route('pages.home') }}"
                                title="Back to the home page">Home</a><span class="main-title"><i
                                    class="icon anm anm-angle-right-l"></i>Your Shopping Cart Style1</span>
                        </div>
                        <!--End Breadcrumbs-->
                    </div>
                </div>
            </div>
        </div>
        <!--End Page Header-->

        <!--Main Content-->
        <div class="container">
            <div class="row">
                <!--Cart Content-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 main-col">
                    <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                        <i class="align-middle icon anm anm-truck icon-large me-2"></i><strong
                            class="text-uppercase">Congratulations!</strong> You've got free shipping!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!--End Alert msg-->

                    <!--Cart Form-->
                    <form action="#" method="post" class="cart-table table-bottom-brd">
                        <table class="table align-middle">
                            <thead class="cart-row cart-header small-hide position-relative">
                                <tr>
                                    <th class="action">&nbsp;</th>
                                    <th colspan="2" class="text-start">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart-row cart-flex position-relative">
                                    <td class="cart-delete text-center small-hide"><a href="#"
                                            class="cart-remove remove-icon position-static" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Remove to Cart"><i
                                                class="icon anm anm-times-r"></i></a></td>
                                    <td class="cart-image cart-flex-item">
                                        <a href="{{ route('pages.productDetail') }}"><img
                                                class="cart-image rounded-0 blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product1-120x170.jpg') }}"
                                                src="{{ asset('client/images/products/product1-120x170.jpg') }}"
                                                alt="Sunset Sleep Scarf Top" width="120" height="170" /></a>
                                    </td>
                                    <td class="cart-meta small-text-left cart-flex-item">
                                        <div class="list-view-item-title">
                                            <a href="{{ route('pages.productDetail') }}">Oxford Cuban Shirt</a>
                                        </div>
                                        <div class="cart-meta-text">
                                            Color: Black<br>Size: Small<br>Qty: 2
                                        </div>
                                        <div class="cart-price d-md-none">
                                            <span class="money fw-500">$99.00</span>
                                        </div>
                                    </td>
                                    <td class="cart-price cart-flex-item text-center small-hide">
                                        <span class="money">$99.00</span>
                                    </td>
                                    <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                        <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="#;"><i
                                                        class="icon anm anm-minus-r"></i></a>
                                                <input class="cart-qty-input qty" type="text" name="updates[]"
                                                    value="1" pattern="[0-9]*" />
                                                <a class="qtyBtn plus" href="#;"><i
                                                        class="icon anm anm-plus-r"></i></a>
                                            </div>
                                        </div>
                                        <a href="#" title="Remove"
                                            class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3">Remove</a>
                                    </td>
                                    <td class="cart-price cart-flex-item text-center small-hide">
                                        <span class="money fw-500">$198.00</span>
                                    </td>
                                </tr>
                                <tr class="cart-row cart-flex position-relative">
                                    <td class="cart-delete text-center small-hide"><a href="#"
                                            class="cart-remove remove-icon position-static" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Remove to Cart"><i
                                                class="icon anm anm-times-r"></i></a></td>
                                    <td class="cart-image cart-flex-item">
                                        <a href="{{ route('pages.productDetail') }}"><img
                                                class="cart-image rounded-0 blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-120x170.jpg') }}"
                                                src="{{ asset('client/images/products/product2-120x170.jpg') }}"
                                                alt="Sunset Sleep Scarf Top" width="120" height="170" /></a>
                                    </td>
                                    <td class="cart-meta small-text-left cart-flex-item">
                                        <div class="list-view-item-title">
                                            <a href="{{ route('pages.productDetail') }}">Cuff Beanie Cap</a>
                                        </div>
                                        <div class="cart-meta-text">
                                            Color: Black<br>Size: Small<br>Qty: 1
                                        </div>
                                        <div class="cart-price d-md-none">
                                            <span class="money fw-500">$128.00</span>
                                        </div>
                                    </td>
                                    <td class="cart-price cart-flex-item text-center small-hide">
                                        <span class="money">$128.00</span>
                                    </td>
                                    <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                        <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="#;"><i
                                                        class="icon anm anm-minus-r"></i></a>
                                                <input class="cart-qty-input qty" type="text" name="updates[]"
                                                    value="1" pattern="[0-9]*" />
                                                <a class="qtyBtn plus" href="#;"><i
                                                        class="icon anm anm-plus-r"></i></a>
                                            </div>
                                        </div>
                                        <a href="#" title="Remove"
                                            class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3">Remove</a>
                                    </td>
                                    <td class="cart-price cart-flex-item text-center small-hide">
                                        <span class="money fw-500">$128.00</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-start"><a href="#"
                                            class="btn btn-outline-secondary btn-sm cart-continue"><i
                                                class="icon anm anm-angle-left-r me-2 d-none"></i> Continue shopping</a>
                                    </td>
                                    <td colspan="3" class="text-end">
                                        <button type="submit" name="clear"
                                            class="btn btn-outline-secondary btn-sm small-hide"><i
                                                class="icon anm anm-times-r me-2 d-none"></i> Clear Shoping Cart</button>
                                        <button type="submit" name="update"
                                            class="btn btn-secondary btn-sm cart-continue ms-2"><i
                                                class="icon anm anm-sync-ar me-2 d-none"></i> Update Cart</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <!--End Cart Form-->

                    <!--Note with Shipping estimates-->
                    <div class="row my-4 pt-3">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-12 cart-col">
                            <div class="cart-note mb-4">
                                <h5>Add a note to your order</h5>
                                <label for="cart-note">Notes about your order, e.g. special notes for delivery.</label>
                                <textarea name="note" id="cart-note" class="form-control cart-note-input" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-12 cart-col">
                            <div class="cart-discount">
                                <h5>Discount Codes</h5>
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label for="address_zip">Enter your coupon code if you have one.</label>
                                        <div class="input-group0">
                                            <input class="form-control" type="text" name="coupon" required />
                                            <input type="submit" class="btn text-nowrap mt-3" value="Apply Coupon" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-12 cart-col">
                            <div id="shipping-calculator" class="mt-4 mt-lg-0">
                                <h5>Get shipping estimates</h5>
                                <form class="estimate-form row row-cols-lg-3 row-cols-md-3 row-cols-1" action="#"
                                    method="post">
                                    <div class="form-group">
                                        <label for="address_country">Country</label>
                                        <select id="address_country" name="address[country]"
                                            data-default="United States">
                                            <option value="0" label="Select a country ... " selected="selected">
                                                Select a country...</option>
                                            <optgroup id="country-optgroup-Africa" label="Africa">
                                                <option value="DZ" label="Algeria">Algeria</option>
                                                <option value="AO" label="Angola">Angola</option>
                                                <option value="BJ" label="Benin">Benin</option>
                                                <option value="BW" label="Botswana">Botswana</option>
                                                <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                                <option value="BI" label="Burundi">Burundi</option>
                                                <option value="CM" label="Cameroon">Cameroon</option>
                                                <option value="CV" label="Cape Verde">Cape Verde</option>
                                                <option value="CF" label="Central African Republic">Central African
                                                    Republic</option>
                                                <option value="TD" label="Chad">Chad</option>
                                                <option value="KM" label="Comoros">Comoros</option>
                                                <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville
                                                </option>
                                                <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                                                <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                                                <option value="DJ" label="Djibouti">Djibouti</option>
                                                <option value="EG" label="Egypt">Egypt</option>
                                                <option value="GQ" label="Equatorial Guinea">Equatorial Guinea
                                                </option>
                                                <option value="ER" label="Eritrea">Eritrea</option>
                                                <option value="ET" label="Ethiopia">Ethiopia</option>
                                                <option value="GA" label="Gabon">Gabon</option>
                                                <option value="GM" label="Gambia">Gambia</option>
                                                <option value="GH" label="Ghana">Ghana</option>
                                                <option value="GN" label="Guinea">Guinea</option>
                                                <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="KE" label="Kenya">Kenya</option>
                                                <option value="LS" label="Lesotho">Lesotho</option>
                                                <option value="LR" label="Liberia">Liberia</option>
                                                <option value="LY" label="Libya">Libya</option>
                                                <option value="MG" label="Madagascar">Madagascar</option>
                                                <option value="MW" label="Malawi">Malawi</option>
                                                <option value="ML" label="Mali">Mali</option>
                                                <option value="MR" label="Mauritania">Mauritania</option>
                                                <option value="MU" label="Mauritius">Mauritius</option>
                                                <option value="YT" label="Mayotte">Mayotte</option>
                                                <option value="MA" label="Morocco">Morocco</option>
                                                <option value="MZ" label="Mozambique">Mozambique</option>
                                                <option value="NA" label="Namibia">Namibia</option>
                                                <option value="NE" label="Niger">Niger</option>
                                                <option value="NG" label="Nigeria">Nigeria</option>
                                                <option value="RW" label="Rwanda">Rwanda</option>
                                                <option value="RE" label="Réunion">Réunion</option>
                                                <option value="SH" label="Saint Helena">Saint Helena</option>
                                                <option value="SN" label="Senegal">Senegal</option>
                                                <option value="SC" label="Seychelles">Seychelles</option>
                                                <option value="SL" label="Sierra Leone">Sierra Leone</option>
                                                <option value="SO" label="Somalia">Somalia</option>
                                                <option value="ZA" label="South Africa">South Africa</option>
                                                <option value="SD" label="Sudan">Sudan</option>
                                                <option value="SZ" label="Swaziland">Swaziland</option>
                                                <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe
                                                </option>
                                                <option value="TZ" label="Tanzania">Tanzania</option>
                                                <option value="TG" label="Togo">Togo</option>
                                                <option value="TN" label="Tunisia">Tunisia</option>
                                                <option value="UG" label="Uganda">Uganda</option>
                                                <option value="EH" label="Western Sahara">Western Sahara</option>
                                                <option value="ZM" label="Zambia">Zambia</option>
                                                <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Americas" label="Americas">
                                                <option value="AI" label="Anguilla">Anguilla</option>
                                                <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda
                                                </option>
                                                <option value="AR" label="Argentina">Argentina</option>
                                                <option value="AW" label="Aruba">Aruba</option>
                                                <option value="BS" label="Bahamas">Bahamas</option>
                                                <option value="BB" label="Barbados">Barbados</option>
                                                <option value="BZ" label="Belize">Belize</option>
                                                <option value="BM" label="Bermuda">Bermuda</option>
                                                <option value="BO" label="Bolivia">Bolivia</option>
                                                <option value="BR" label="Brazil">Brazil</option>
                                                <option value="VG" label="British Virgin Islands">British Virgin
                                                    Islands</option>
                                                <option value="CA" label="Canada">Canada</option>
                                                <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                                <option value="CL" label="Chile">Chile</option>
                                                <option value="CO" label="Colombia">Colombia</option>
                                                <option value="CR" label="Costa Rica">Costa Rica</option>
                                                <option value="CU" label="Cuba">Cuba</option>
                                                <option value="DM" label="Dominica">Dominica</option>
                                                <option value="DO" label="Dominican Republic">Dominican Republic
                                                </option>
                                                <option value="EC" label="Ecuador">Ecuador</option>
                                                <option value="SV" label="El Salvador">El Salvador</option>
                                                <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                                <option value="GF" label="French Guiana">French Guiana</option>
                                                <option value="GL" label="Greenland">Greenland</option>
                                                <option value="GD" label="Grenada">Grenada</option>
                                                <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                                <option value="GT" label="Guatemala">Guatemala</option>
                                                <option value="GY" label="Guyana">Guyana</option>
                                                <option value="HT" label="Haiti">Haiti</option>
                                                <option value="HN" label="Honduras">Honduras</option>
                                                <option value="JM" label="Jamaica">Jamaica</option>
                                                <option value="MQ" label="Martinique">Martinique</option>
                                                <option value="MX" label="Mexico">Mexico</option>
                                                <option value="MS" label="Montserrat">Montserrat</option>
                                                <option value="AN" label="Netherlands Antilles">Netherlands Antilles
                                                </option>
                                                <option value="NI" label="Nicaragua">Nicaragua</option>
                                                <option value="PA" label="Panama">Panama</option>
                                                <option value="PY" label="Paraguay">Paraguay</option>
                                                <option value="PE" label="Peru">Peru</option>
                                                <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                                <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                                <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis
                                                </option>
                                                <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                                <option value="MF" label="Saint Martin">Saint Martin</option>
                                                <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and
                                                    Miquelon</option>
                                                <option value="VC" label="Saint Vincent and the Grenadines">Saint
                                                    Vincent and the Grenadines</option>
                                                <option value="SR" label="Suriname">Suriname</option>
                                                <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago
                                                </option>
                                                <option value="TC" label="Turks and Caicos Islands">Turks and Caicos
                                                    Islands</option>
                                                <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands
                                                </option>
                                                <option value="US" label="United States">United States</option>
                                                <option value="UY" label="Uruguay">Uruguay</option>
                                                <option value="VE" label="Venezuela">Venezuela</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Asia" label="Asia">
                                                <option value="AF" label="Afghanistan">Afghanistan</option>
                                                <option value="AM" label="Armenia">Armenia</option>
                                                <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                                <option value="BH" label="Bahrain">Bahrain</option>
                                                <option value="BD" label="Bangladesh">Bangladesh</option>
                                                <option value="BT" label="Bhutan">Bhutan</option>
                                                <option value="BN" label="Brunei">Brunei</option>
                                                <option value="KH" label="Cambodia">Cambodia</option>
                                                <option value="CN" label="China">China</option>
                                                <option value="GE" label="Georgia">Georgia</option>
                                                <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China
                                                </option>
                                                <option value="IN" label="India">India</option>
                                                <option value="ID" label="Indonesia">Indonesia</option>
                                                <option value="IR" label="Iran">Iran</option>
                                                <option value="IQ" label="Iraq">Iraq</option>
                                                <option value="IL" label="Israel">Israel</option>
                                                <option value="JP" label="Japan">Japan</option>
                                                <option value="JO" label="Jordan">Jordan</option>
                                                <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                                <option value="KW" label="Kuwait">Kuwait</option>
                                                <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="LA" label="Laos">Laos</option>
                                                <option value="LB" label="Lebanon">Lebanon</option>
                                                <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                                <option value="MY" label="Malaysia">Malaysia</option>
                                                <option value="MV" label="Maldives">Maldives</option>
                                                <option value="MN" label="Mongolia">Mongolia</option>
                                                <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                                <option value="NP" label="Nepal">Nepal</option>
                                                <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                                <option value="KP" label="North Korea">North Korea</option>
                                                <option value="OM" label="Oman">Oman</option>
                                                <option value="PK" label="Pakistan">Pakistan</option>
                                                <option value="PS" label="Palestinian Territories">Palestinian
                                                    Territories</option>
                                                <option value="YD" label="People's Democratic Republic of Yemen">
                                                    People's Democratic Republic of Yemen</option>
                                                <option value="PH" label="Philippines">Philippines</option>
                                                <option value="QA" label="Qatar">Qatar</option>
                                                <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                                <option value="SG" label="Singapore">Singapore</option>
                                                <option value="KR" label="South Korea">South Korea</option>
                                                <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                                <option value="SY" label="Syria">Syria</option>
                                                <option value="TW" label="Taiwan">Taiwan</option>
                                                <option value="TJ" label="Tajikistan">Tajikistan</option>
                                                <option value="TH" label="Thailand">Thailand</option>
                                                <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                                <option value="TR" label="Turkey">Turkey</option>
                                                <option value="TM" label="Turkmenistan">Turkmenistan</option>
                                                <option value="AE" label="United Arab Emirates">United Arab Emirates
                                                </option>
                                                <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                                <option value="VN" label="Vietnam">Vietnam</option>
                                                <option value="YE" label="Yemen">Yemen</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Europe" label="Europe">
                                                <option value="AL" label="Albania">Albania</option>
                                                <option value="AD" label="Andorra">Andorra</option>
                                                <option value="AT" label="Austria">Austria</option>
                                                <option value="BY" label="Belarus">Belarus</option>
                                                <option value="BE" label="Belgium">Belgium</option>
                                                <option value="BA" label="Bosnia and Herzegovina">Bosnia and
                                                    Herzegovina</option>
                                                <option value="BG" label="Bulgaria">Bulgaria</option>
                                                <option value="HR" label="Croatia">Croatia</option>
                                                <option value="CY" label="Cyprus">Cyprus</option>
                                                <option value="CZ" label="Czech Republic">Czech Republic</option>
                                                <option value="DK" label="Denmark">Denmark</option>
                                                <option value="DD" label="East Germany">East Germany</option>
                                                <option value="EE" label="Estonia">Estonia</option>
                                                <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                                <option value="FI" label="Finland">Finland</option>
                                                <option value="FR" label="France">France</option>
                                                <option value="DE" label="Germany">Germany</option>
                                                <option value="GI" label="Gibraltar">Gibraltar</option>
                                                <option value="GR" label="Greece">Greece</option>
                                                <option value="GG" label="Guernsey">Guernsey</option>
                                                <option value="HU" label="Hungary">Hungary</option>
                                                <option value="IS" label="Iceland">Iceland</option>
                                                <option value="IE" label="Ireland">Ireland</option>
                                                <option value="IM" label="Isle of Man">Isle of Man</option>
                                                <option value="IT" label="Italy">Italy</option>
                                                <option value="JE" label="Jersey">Jersey</option>
                                                <option value="LV" label="Latvia">Latvia</option>
                                                <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                                <option value="LT" label="Lithuania">Lithuania</option>
                                                <option value="LU" label="Luxembourg">Luxembourg</option>
                                                <option value="MK" label="Macedonia">Macedonia</option>
                                                <option value="MT" label="Malta">Malta</option>
                                                <option value="FX" label="Metropolitan France">Metropolitan France
                                                </option>
                                                <option value="MD" label="Moldova">Moldova</option>
                                                <option value="MC" label="Monaco">Monaco</option>
                                                <option value="ME" label="Montenegro">Montenegro</option>
                                                <option value="NL" label="Netherlands">Netherlands</option>
                                                <option value="NO" label="Norway">Norway</option>
                                                <option value="PL" label="Poland">Poland</option>
                                                <option value="PT" label="Portugal">Portugal</option>
                                                <option value="RO" label="Romania">Romania</option>
                                                <option value="RU" label="Russia">Russia</option>
                                                <option value="SM" label="San Marino">San Marino</option>
                                                <option value="RS" label="Serbia">Serbia</option>
                                                <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro
                                                </option>
                                                <option value="SK" label="Slovakia">Slovakia</option>
                                                <option value="SI" label="Slovenia">Slovenia</option>
                                                <option value="ES" label="Spain">Spain</option>
                                                <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan
                                                    Mayen</option>
                                                <option value="SE" label="Sweden">Sweden</option>
                                                <option value="CH" label="Switzerland">Switzerland</option>
                                                <option value="UA" label="Ukraine">Ukraine</option>
                                                <option value="SU" label="Union of Soviet Socialist Republics">Union
                                                    of Soviet Socialist Republics</option>
                                                <option value="GB" label="United Kingdom">United Kingdom</option>
                                                <option value="VA" label="Vatican City">Vatican City</option>
                                                <option value="AX" label="Åland Islands">Åland Islands</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Oceania" label="Oceania">
                                                <option value="AS" label="American Samoa">American Samoa</option>
                                                <option value="AQ" label="Antarctica">Antarctica</option>
                                                <option value="AU" label="Australia">Australia</option>
                                                <option value="BV" label="Bouvet Island">Bouvet Island</option>
                                                <option value="IO" label="British Indian Ocean Territory">British
                                                    Indian Ocean Territory</option>
                                                <option value="CX" label="Christmas Island">Christmas Island</option>
                                                <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling]
                                                    Islands</option>
                                                <option value="CK" label="Cook Islands">Cook Islands</option>
                                                <option value="FJ" label="Fiji">Fiji</option>
                                                <option value="PF" label="French Polynesia">French Polynesia</option>
                                                <option value="TF" label="French Southern Territories">French Southern
                                                    Territories</option>
                                                <option value="GU" label="Guam">Guam</option>
                                                <option value="HM" label="Heard Island and McDonald Islands">Heard
                                                    Island and McDonald Islands</option>
                                                <option value="KI" label="Kiribati">Kiribati</option>
                                                <option value="MH" label="Marshall Islands">Marshall Islands</option>
                                                <option value="FM" label="Micronesia">Micronesia</option>
                                                <option value="NR" label="Nauru">Nauru</option>
                                                <option value="NC" label="New Caledonia">New Caledonia</option>
                                                <option value="NZ" label="New Zealand">New Zealand</option>
                                                <option value="NU" label="Niue">Niue</option>
                                                <option value="NF" label="Norfolk Island">Norfolk Island</option>
                                                <option value="MP" label="Northern Mariana Islands">Northern Mariana
                                                    Islands</option>
                                                <option value="PW" label="Palau">Palau</option>
                                                <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                                                <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                                                <option value="WS" label="Samoa">Samoa</option>
                                                <option value="SB" label="Solomon Islands">Solomon Islands</option>
                                                <option value="GS"
                                                    label="South Georgia and the South Sandwich Islands">South Georgia and
                                                    the South Sandwich Islands</option>
                                                <option value="TK" label="Tokelau">Tokelau</option>
                                                <option value="TO" label="Tonga">Tonga</option>
                                                <option value="TV" label="Tuvalu">Tuvalu</option>
                                                <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor
                                                    Outlying Islands</option>
                                                <option value="VU" label="Vanuatu">Vanuatu</option>
                                                <option value="WF" label="Wallis and Futuna">Wallis and Futuna
                                                </option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_province">State</label>
                                        <select id="address_province" name="address[province]" data-default="">
                                            <option value="0" label="Select a state..." selected="selected">Select a
                                                state...</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District Of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_zip">Postal/Zip Code</label>
                                        <input type="text" id="address_zip" name="address[zip]" />
                                    </div>
                                    <div class="actionRow">
                                        <input type="button" class="btn btn-secondary get-rates"
                                            value="Calculate shipping" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Note with Shipping estimates-->
                </div>
                <!--End Cart Content-->

                <!--Cart Sidebar-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart-footer">
                    <div class="cart-info sidebar-sticky">
                        <div class="cart-order-detail cart-col">
                            <div class="row g-0 border-bottom pb-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">$226.00</span></span>
                            </div>
                            <div class="row g-0 border-bottom py-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Coupon Discount</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">-$25.00</span></span>
                            </div>
                            <div class="row g-0 border-bottom py-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">$10.00</span></span>
                            </div>
                            <div class="row g-0 border-bottom py-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">Free shipping</span></span>
                            </div>
                            <div class="row g-0 pt-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                <span
                                    class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                        class="money">$311.00</b></span>
                            </div>

                            <p class="cart-shipping mt-3">Shipping &amp; taxes calculated at checkout</p>
                            <p class="cart-shipping fst-normal freeShipclaim"><i
                                    class="me-2 align-middle icon anm anm-truck-l"></i><b>FREE SHIPPING</b> ELIGIBLE</p>
                            <div class="customCheckbox cart-tearm">
                                <input type="checkbox" value="allen-vela" id="cart-tearm">
                                <label for="cart-tearm">I agree with the terms and conditions</label>
                            </div>
                            <a href="checkout-style1.html" id="cartCheckout"
                                class="btn btn-lg my-4 checkout w-100">Proceed To Checkout</a>
                            <div class="paymnet-img text-center"><img
                                    src="{{ asset('client/images/icons/safepayment.png') }}"
                                    alt="Payment" width="299" height="28" /></div>
                        </div>
                    </div>
                </div>
                <!--End Cart Sidebar-->
            </div>
        </div>
        <!--End Main Content-->

        <!--Related Products-->
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="section-header">
                    <h2>You may also like</h2>
                </div>
                <!--Product Grid-->
                <div class="product-slider-4items gp10 arwOut5 grid-products">
                    <div class="item col-item">
                        <div class="product-box">
                            <!-- Start Product Image -->
                            <div class="product-image">
                                <!-- Start Product Image -->
                                <a href="{{ route('pages.productDetail') }}" class="product-img rounded-0"><img
                                        class="rounded-0 blur-up lazyload" src="{{ asset('client/images/products/product1.jpg') }}"
                                        alt="Product" title="Product" width="625" height="808" /></a>
                                <!-- End Product Image -->
                                <!-- Product label -->
                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                <!-- End Product label -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <a href="#quickshop-modal" class="btn-icon addtocart quick-shop-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickshop_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Quick Shop"><i
                                                class="icon anm anm-cart-l"></i><span class="text">Quick
                                                Shop</span></span>
                                    </a>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Quick View"><i
                                                class="icon anm anm-search-plus-l"></i><span class="text">Quick
                                                View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add To Wishlist"><i
                                            class="icon anm anm-heart-l"></i><span class="text">Add To
                                            Wishlist</span></a>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <a href="compare-style2.html" class="btn-icon compare" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to Compare"><i
                                            class="icon anm anm-random-r"></i><span class="text">Add to
                                            Compare</span></a>
                                    <!--End Compare Button-->
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- End Product Image -->
                            <!-- Start Product Details -->
                            <div class="product-details text-left">
                                <!-- Product Name -->
                                <div class="product-name">
                                    <a href="{{ route('pages.productDetail') }}">Oxford Cuban Shirt</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price old-price">$114.00</span><span class="price">$99.00</span>
                                </div>
                                <!-- End Product Price -->
                                <!-- Product Review -->
                                <div class="product-review">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star-o"></i>
                                    <span class="caption hidden ms-1">3 Reviews</span>
                                </div>
                                <!-- End Product Review -->
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                    <div class="item col-item">
                        <div class="product-box">
                            <!-- Start Product Image -->
                            <div class="product-image">
                                <!-- Start Product Image -->
                                <a href="{{ route('pages.productDetail') }}" class="product-img rounded-0">
                                    <!-- Image -->
                                    <img class="primary rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product2.jpg') }}"
                                        src="{{ asset('client/images/products/product2.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Image -->
                                    <!-- Hover Image -->
                                    <img class="hover rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                        src="{{ asset('client/images/products/product2-1.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Hover Image -->
                                </a>
                                <!-- End Product Image -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <a href="#quickshop-modal" class="btn-icon addtocart quick-shop-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickshop_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Select Options"><i
                                                class="icon anm anm-cart-l"></i><span class="text">Select
                                                Options</span></span>
                                    </a>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Quick View"><i
                                                class="icon anm anm-search-plus-l"></i><span class="text">Quick
                                                View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add To Wishlist"><i
                                            class="icon anm anm-heart-l"></i><span class="text">Add To
                                            Wishlist</span></a>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <a href="compare-style2.html" class="btn-icon compare" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to Compare"><i
                                            class="icon anm anm-random-r"></i><span class="text">Add to
                                            Compare</span></a>
                                    <!--End Compare Button-->
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- End Product Image -->
                            <!-- Start Product Details -->
                            <div class="product-details text-left">
                                <!-- Product Name -->
                                <div class="product-name">
                                    <a href="{{ route('pages.productDetail') }}">Cuff Beanie Cap</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price">$128.00</span>
                                </div>
                                <!-- End Product Price -->
                                <!-- Product Review -->
                                <div class="product-review">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i>
                                    <span class="caption hidden ms-1">8 Reviews</span>
                                </div>
                                <!-- End Product Review -->
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                    <div class="item col-item">
                        <div class="product-box">
                            <!-- Start Product Image -->
                            <div class="product-image">
                                <!-- Start Product Image -->
                                <a href="{{ route('pages.productDetail') }}" class="product-img rounded-0">
                                    <!-- Image -->
                                    <img class="primary rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product3.jpg') }}"
                                        src="{{ asset('client/images/products/product3.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Image -->
                                    <!-- Hover Image -->
                                    <img class="hover rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product3-1.jpg') }}"
                                        src="{{ asset('client/images/products/product3-1.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Hover Image -->
                                </a>
                                <!-- End Product Image -->
                                <!-- Product label -->
                                <div class="product-labels"><span class="lbl pr-label3">Trending</span></div>
                                <!-- End Product label -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <a href="#addtocart-modal" class="btn-icon addtocart add-to-cart-modal"
                                        data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Add to Cart"><i
                                                class="icon anm anm-cart-l"></i><span class="text">Add to
                                                Cart</span></span>
                                    </a>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Quick View"><i
                                                class="icon anm anm-search-plus-l"></i><span class="text">Quick
                                                View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add To Wishlist"><i
                                            class="icon anm anm-heart-l"></i><span class="text">Add To
                                            Wishlist</span></a>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <a href="compare-style2.html" class="btn-icon compare" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to Compare"><i
                                            class="icon anm anm-random-r"></i><span class="text">Add to
                                            Compare</span></a>
                                    <!--End Compare Button-->
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- End Product Image -->
                            <!-- Start Product Details -->
                            <div class="product-details text-left">
                                <!-- Product Name -->
                                <div class="product-name">
                                    <a href="{{ route('pages.productDetail') }}">Flannel Collar Shirt</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price">$99.00</span>
                                </div>
                                <!-- End Product Price -->
                                <!-- Product Review -->
                                <div class="product-review">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                        class="icon anm anm-star-o"></i>
                                    <span class="caption hidden ms-1">10 Reviews</span>
                                </div>
                                <!-- End Product Review -->
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                    <div class="item col-item">
                        <div class="product-box">
                            <!-- Start Product Image -->
                            <div class="product-image">
                                <!-- Start Product Image -->
                                <a href="{{ route('pages.productDetail') }}" class="product-img rounded-0">
                                    <!-- Image -->
                                    <img class="primary rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product4.jpg') }}"
                                        src="{{ asset('client/images/products/product4.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Image -->
                                    <!-- Hover Image -->
                                    <img class="hover rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product4-1.jpg') }}"
                                        src="{{ asset('client/images/products/product4-1.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Hover Image -->
                                </a>
                                <!-- End Product Image -->
                                <!-- Product label -->
                                <div class="product-labels"><span class="lbl on-sale">50% Off</span></div>
                                <!-- End Product label -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <a href="#addtocart-modal" class="btn-icon addtocart add-to-cart-modal"
                                        data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Cart"><i
                                                class="icon anm anm-cart-l"></i><span class="text">Add to
                                                Cart</span></span>
                                    </a>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="icon anm anm-search-plus-l"></i><span class="text">Quick
                                                View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add To Wishlist"><i
                                            class="icon anm anm-heart-l"></i><span class="text">Add To
                                            Wishlist</span></a>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <a href="compare-style2.html" class="btn-icon compare" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to Compare"><i
                                            class="icon anm anm-random-r"></i><span class="text">Add to
                                            Compare</span></a>
                                    <!--End Compare Button-->
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- End Product Image -->
                            <!-- Start Product Details -->
                            <div class="product-details text-left">
                                <!-- Product Name -->
                                <div class="product-name">
                                    <a href="{{ route('pages.productDetail') }}">Cotton Hooded Hoodie</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price old-price">$198.00</span><span class="price">$99.00</span>
                                </div>
                                <!-- End Product Price -->
                                <!-- Product Review -->
                                <div class="product-review">
                                    <i class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                        class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                        class="icon anm anm-star-o"></i>
                                    <span class="caption hidden ms-1">0 Reviews</span>
                                </div>
                                <!-- End Product Review -->
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                    <div class="item col-item">
                        <div class="product-box">
                            <!-- Start Product Image -->
                            <div class="product-image">
                                <!-- Start Product Image -->
                                <a href="{{ route('pages.productDetail') }}" class="product-img rounded-0">
                                    <!-- Image -->
                                    <img class="primary rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product5.jpg') }}"
                                        src="{{ asset('client/images/products/product5.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Image -->
                                    <!-- Hover Image -->
                                    <img class="hover rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/product5-1.jpg') }}"
                                        src="{{ asset('client/images/products/product5-1.jpg') }}" alt="Product" title="Product"
                                        width="625" height="808" />
                                    <!-- End Hover Image -->
                                </a>
                                <!-- End Product Image -->
                                <!-- Product label -->
                                <div class="product-labels"><span class="lbl pr-label2">Hot</span></div>
                                <!-- End Product label -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <a href="#addtocart-modal" class="btn-icon addtocart add-to-cart-modal"
                                        data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Cart"><i
                                                class="icon anm anm-cart-l"></i><span class="text">Add to
                                                Cart</span></span>
                                    </a>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="icon anm anm-search-plus-l"></i><span class="text">Quick
                                                View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add To Wishlist"><i
                                            class="icon anm anm-heart-l"></i><span class="text">Add To
                                            Wishlist</span></a>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <a href="compare-style2.html" class="btn-icon compare" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to Compare"><i
                                            class="icon anm anm-random-r"></i><span class="text">Add to
                                            Compare</span></a>
                                    <!--End Compare Button-->
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- End Product Image -->
                            <!-- Start Product Details -->
                            <div class="product-details text-left">
                                <!-- Product Name -->
                                <div class="product-name">
                                    <a href="{{ route('pages.productDetail') }}">Denim Women Shorts</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price">$39.00</span>
                                </div>
                                <!-- End Product Price -->
                                <!-- Product Review -->
                                <div class="product-review">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                        class="icon anm anm-star-o"></i>
                                    <span class="caption hidden ms-1">3 Reviews</span>
                                </div>
                                <!-- End Product Review -->
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                </div>
                <!--End Product Grid-->
            </div>
        </section>
        <!--End Related Products-->
    </div>
    <!-- End Body Container -->

    <!-- Product Quickshop Modal-->
    <div class="quickshop-modal modal fade" id="quickshop_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form method="post" action="#" id="product-form-quickshop"
                        class="product-form align-items-center">
                        @csrf
                        <!-- Product Info -->
                        <div class="row g-0 item mb-3">
                            <a class="col-4 product-image" href="{{ route('pages.productDetail') }}"><img
                                    class="blur-up lazyload"
                                    data-src="{{ asset('client/images/products/addtocart-modal.jpg') }}"
                                    src="{{ asset('client/images/products/addtocart-modal.jpg') }}" alt="Product"
                                    title="Product" width="625" height="800" /></a>
                            <div class="col-8 product-details">
                                <div class="product-variant ps-3">
                                    <a class="product-title" href="{{ route('pages.productDetail') }}">Weave Hoodie
                                        Sweatshirt</a>
                                    <div class="priceRow mt-2 mb-3">
                                        <div class="product-price m-0">
                                            <span class="old-price">$114.00</span><span class="price">$99.00</span>
                                        </div>
                                    </div>
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;"><i
                                                class="icon anm anm-minus-r"></i></a>
                                        <input type="text" name="quantity" value="1" class="qty" />
                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Product Info -->
                        <!-- Swatches Color -->
                        <div class="variants-clr swatches-image clearfix mb-3 swatch-0 option1" data-option-index="0">
                            <label class="label d-flex justify-content-center">Color:<span
                                    class="slVariant ms-1 fw-bold">Black</span></label>
                            <ul class="swatches d-flex-justify-center pt-1 clearfix">
                                <li class="swatch large radius available active">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                        alt="image" width="70" height="70" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Blue" />
                                </li>
                                <li class="swatch large radius available">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                        alt="image" width="70" height="70" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Black" />
                                </li>
                                <li class="swatch large radius available">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                        alt="image" width="70" height="70" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Pink" />
                                </li>
                                <li class="swatch large radius available green">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Green"></span>
                                </li>
                                <li class="swatch large radius soldout yellow">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Yellow"></span>
                                </li>
                            </ul>
                        </div>
                        <!-- End Swatches Color -->
                        <!-- Swatches Size -->
                        <div class="variants-size swatches-size clearfix mb-4 swatch-1 option2" data-option-index="1">
                            <label class="label d-flex justify-content-center">Size:<span
                                    class="slVariant ms-1 fw-bold">S</span></label>
                            <ul class="size-swatches d-flex-justify-center pt-1 clearfix">
                                <li class="swatch large radius soldout">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="XS">XS</span>
                                </li>
                                <li class="swatch large radius available active">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="S">S</span>
                                </li>
                                <li class="swatch large radius available">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="M">M</span>
                                </li>
                                <li class="swatch large radius available">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="L">L</span>
                                </li>
                                <li class="swatch large radius available">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="XL">XL</span>
                                </li>
                            </ul>
                        </div>
                        <!-- End Swatches Size -->
                        <!-- Product Action -->
                        <div class="product-form-submit d-flex-justify-center">
                            <button type="submit" name="add" class="btn product-cart-submit me-2">
                                <span>Add to cart</span>
                            </button>
                            <button type="submit" name="sold" class="btn btn-secondary product-sold-out d-none"
                                disabled="disabled">
                                Sold out
                            </button>
                            <button type="submit" name="buy" class="btn btn-secondary proceed-to-checkout">
                                Buy it now
                            </button>
                        </div>
                        <!-- End Product Action -->
                        <div class="text-center mt-3">
                            <a class="text-link" href="{{ route('pages.productDetail') }}">View More Details</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Quickshop Modal -->

    <!-- Product Addtocart Modal-->
    <div class="addtocart-modal modal fade" id="addtocart_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form method="post" action="#" id="product-form-addtocart"
                        class="product-form align-items-center">
                        @csrf
                        <h3 class="title mb-3 text-success text-center">
                            Added to cart Successfully!
                        </h3>
                        <div class="row d-flex-center text-center">
                            <div class="col-md-6">
                                <!-- Product Image -->
                                <a class="product-image" href="{{ route('pages.productDetail') }}"><img
                                        class="blur-up lazyload"
                                        data-src="{{ asset('client/images/products/addtocart-modal.jpg') }}"
                                        src="{{ asset('client/images/products/addtocart-modal.jpg') }}" alt="Product"
                                        title="Product" width="625" height="800" /></a>
                                <!-- End Product Image -->
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <!-- Product Info -->
                                <div class="product-details">
                                    <a class="product-title" href="{{ route('pages.productDetail') }}">Cuff Beanie
                                        Cap</a>
                                    <p class="product-clr my-2 text-muted">Black / XL</p>
                                </div>
                                <div class="addcart-total rounded-5">
                                    <p class="product-items mb-2">
                                        There are <strong>1</strong> items in your cart
                                    </p>
                                    <p class="d-flex-justify-center">
                                        Total: <span class="price">$198.00</span>
                                    </p>
                                </div>
                                <!-- End Product Info -->
                                <!-- Product Action -->
                                <div class="product-form-submit d-flex-justify-center">
                                    <a href="#" class="btn btn-outline-primary product-continue w-100">Continue
                                        Shopping</a>
                                    <a href="cart-style1.html"
                                        class="btn btn-secondary product-viewcart w-100 my-2 my-md-3">View Cart</a>
                                    <a href="checkout-style1.html"
                                        class="btn btn-primary product-checkout w-100">Proceed to checkout</a>
                                </div>
                                <!-- End Product Action -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Addtocart Modal -->

    <!-- Product Quickview Modal-->
    <div class="quickview-modal modal fade" id="quickview_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 mb-md-0">
                            <!-- Model Thumbnail -->
                            <div id="quickView" class="carousel slide">
                                <!-- Image Slide carousel items -->
                                <div class="carousel-inner">
                                    <div class="item carousel-item active" data-bs-slide-number="0">
                                        <img class="blur-up lazyload" data-src="assets/images/products/product2.jpg"
                                            src="{{ asset('client/images/products/product2.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="1">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                            src="{{ asset('client/images/products/product2-1.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="2">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-2.jpg') }}"
                                            src="{{ asset('client/images/products/product2-2.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="3">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-3.jpg') }}"
                                            src="{{ asset('client/images/products/product2-3.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="4">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-4.jpg') }}"
                                            src="{{ asset('client/images/products/product2-4.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="5">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product5.jpg') }}"
                                            src="{{ asset('client/images/products/product2-5.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                </div>
                                <!-- End Image Slide carousel items -->
                                <!-- Thumbnail image -->
                                <div class="model-thumbnail-img">
                                    <!-- Thumbnail slide -->
                                    <div class="carousel-indicators list-inline">
                                        <div class="list-inline-item active" id="carousel-selector-0"
                                            data-bs-slide-to="0" data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2.jpg') }}"
                                                src="{{ asset('client/images/products/product2.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-1" data-bs-slide-to="1"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                                src="{{ asset('client/images/products/product2-1.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-2" data-bs-slide-to="2"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-2.jpg') }}"
                                                src="{{ asset('client/images/products/product2-2.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-3" data-bs-slide-to="3"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-3.jpg') }}"
                                                src="{{ asset('client/images/products/product2-3.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-4" data-bs-slide-to="4"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-4.jpg') }}"
                                                src="{{ asset('client/images/products/product2-4.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-5" data-bs-slide-to="5"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-5.jpg') }}"
                                                src="{{ asset('client/images/products/product2-5.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                    </div>
                                    <!-- End Thumbnail slide -->
                                    <!-- Carousel arrow button -->
                                    <a class="carousel-control-prev carousel-arrow rounded-1" href="#quickView"
                                        data-bs-target="#quickView" data-bs-slide="prev"><i
                                            class="icon anm anm-angle-left-r"></i></a>
                                    <a class="carousel-control-next carousel-arrow rounded-1" href="#quickView"
                                        data-bs-target="#quickView" data-bs-slide="next"><i
                                            class="icon anm anm-angle-right-r"></i></a>
                                    <!-- End Carousel arrow button -->
                                </div>
                                <!-- End Thumbnail image -->
                            </div>
                            <!-- End Model Thumbnail -->
                            <div class="text-center mt-3">
                                <a href="{{ route('pages.productDetail') }}" class="text-link">View More Details</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="product-arrow d-flex justify-content-between">
                                <h2 class="product-title">Product Quick View Popup</h2>
                            </div>
                            <div class="product-review d-flex mt-0 mb-2">
                                <div class="rating">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star-o"></i>
                                </div>
                                <div class="reviews ms-2"><a href="#">6 Reviews</a></div>
                            </div>
                            <div class="product-info">
                                <p class="product-vendor">
                                    Vendor:<span class="text"><a href="#">Sparx</a></span>
                                </p>
                                <p class="product-type">
                                    Product Type:<span class="text">Caps</span>
                                </p>
                                <p class="product-sku">
                                    SKU:<span class="text">RF104456</span>
                                </p>
                            </div>
                            <div class="pro-stockLbl my-2">
                                <span class="d-flex-center stockLbl instock d-none"><i
                                        class="icon anm anm-check-cil"></i><span> In stock</span></span>
                                <span class="d-flex-center stockLbl preorder d-none"><i
                                        class="icon anm anm-clock-r"></i><span> Pre-order Now</span></span>
                                <span class="d-flex-center stockLbl outstock d-none"><i
                                        class="icon anm anm-times-cil"></i>
                                    <span>Sold out</span></span>
                                <span class="d-flex-center stockLbl lowstock" data-qty="15"><i
                                        class="icon anm anm-exclamation-cir"></i><span>
                                        Order now, Only
                                        <span class="items">10</span> left!</span></span>
                            </div>
                            <div class="product-price d-flex-center my-3">
                                <span class="price old-price">$135.00</span><span class="price">$99.00</span>
                            </div>
                            <div class="sort-description">
                                The standard chunk of Lorem Ipsum used since the 1500s is
                                reproduced below for those interested.
                            </div>
                            <form method="post" action="#" id="product_form--option" class="product-form">
                                @csrf
                                <div class="product-options d-flex-wrap">
                                    <div class="product-item swatches-image w-100 mb-3 swatch-0 option1"
                                        data-option-index="0">
                                        <label class="label d-flex align-items-center">Color:<span
                                                class="slVariant ms-1 fw-bold">Blue</span></label>
                                        <ul class="variants-clr swatches d-flex-center pt-1 clearfix">
                                            <li class="swatch large radius available active">
                                                <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                                    alt="image" width="70" height="70"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blue" />
                                            </li>
                                            <li class="swatch large radius available">
                                                <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                                    alt="image" width="70" height="70"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Black" />
                                            </li>
                                            <li class="swatch large radius available">
                                                <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                                    alt="image" width="70" height="70"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pink" />
                                            </li>
                                            <li class="swatch large radius available green">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Green"></span>
                                            </li>
                                            <li class="swatch large radius soldout yellow">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Yellow"></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-item swatches-size w-100 mb-3 swatch-1 option2"
                                        data-option-index="1">
                                        <label class="label d-flex align-items-center">Size:<span
                                                class="slVariant ms-1 fw-bold">S</span></label>
                                        <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                                            <li class="swatch large radius soldout">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="XS">XS</span>
                                            </li>
                                            <li class="swatch large radius available active">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="S">S</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="M">M</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="L">L</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="XL">XL</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-action d-flex-wrap w-100 pt-1 mb-3 clearfix">
                                        <div class="quantity">
                                            <div class="qtyField rounded">
                                                <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"
                                                        aria-hidden="true"></i></a>
                                                <input type="text" name="quantity" value="1"
                                                    class="product-form__input qty" />
                                                <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-l"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="addtocart ms-3 fl-1">
                                            <button type="submit" name="add"
                                                class="btn product-cart-submit w-100">
                                                <span>Add to cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="wishlist-btn d-flex-center">
                                <a class="add-wishlist d-flex-center me-3" href="wishlist-style1.html"
                                    title="Add to Wishlist"><i class="icon anm anm-heart-l me-1"></i>
                                    <span>Add to Wishlist</span></a>
                                <a class="add-compare d-flex-center" href="compare-style1.html"
                                    title="Add to Compare"><i class="icon anm anm-random-r me-2"></i>
                                    <span>Add to Compare</span></a>
                            </div>
                            <!-- Social Sharing -->
                            <div class="social-sharing share-icon d-flex-center mx-0 mt-3">
                                <span class="sharing-lbl">Share :</span>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-facebook"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i
                                        class="icon anm anm-facebook-f"></i><span
                                        class="share-title d-none">Facebook</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-twitter"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i
                                        class="icon anm anm-twitter"></i><span
                                        class="share-title d-none">Tweet</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i
                                        class="icon anm anm-pinterest-p"></i>
                                    <span class="share-title d-none">Pin it</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i
                                        class="icon anm anm-linkedin-in"></i><span
                                        class="share-title d-none">Instagram</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share on WhatsApp"><i
                                        class="icon anm anm-envelope-l"></i><span
                                        class="share-title d-none">WhatsApp</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-email"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i
                                        class="icon anm anm-whatsapp"></i><span
                                        class="share-title d-none">Email</span></a>
                            </div>
                            <!-- End Social Sharing -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Product Quickview Modal-->
@endsection
