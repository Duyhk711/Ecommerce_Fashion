@extends('layouts.client')

@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <!--Nav step checkout-->
                    <div id="nav-tabs" class="step-checkout">
                        <ul class="nav nav-tabs step-items">
                            <li class="nav-item onactive">
                                <a class="nav-link active" data-bs-toggle="tab" href="#steps1">Checkout Method</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#steps2">Address</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#steps3">Order Summary</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#steps4">Payment</a>
                            </li>
                        </ul>
                    </div>
                    <!--End Nav step checkout-->

                    <!--Tab checkout content-->
                    <div class="tab-content checkout-form">
                        <div class="tab-pane active" id="steps1">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 mb-md-0">
                                    <div class="block h-100">
                                        <div class="block-content">
                                            <h3 class="title">Check As a Guest or Register</h3>
                                            <p class="text-gray">Register with us for future convenience:</p>
                                            <ul class="list-unstyled radio-group mb-4">
                                                <li>
                                                    <div class="checkout customRadio">
                                                        <input type="radio" id="option-1" name="selector"
                                                            checked="" />
                                                        <label for="option-1"> Checkout as guest</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout customRadio">
                                                        <input type="radio" id="option-2" name="selector" />
                                                        <label for="option-2"> Register</label>
                                                    </div>
                                                </li>
                                            </ul>

                                            <h3 class="title">Register and save time !</h3>
                                            <p class="text-gray">Register with us for future convenience:</p>
                                            <ul class="lists-style1 text-gray mb-3">
                                                <li>Fast and easy check out</li>
                                                <li>Easy access to your order history and status</li>
                                            </ul>
                                            <button type="submit" name="Continue" class="btn btn-primary">Continue</button>
                                            <button type="submit" name="Continue"
                                                class="btn btn-secondary ms-2 btnNext">Next Address</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="block h-100">
                                        <div class="block-content">
                                            <form method="post" action="#" class="login-form">
                                                <h3 class="title">Already Register ?</h3>
                                                <p class="text-gray">Please log in below :</p>
                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <label for="CustomerEmail" class="form-label">Email Address <span
                                                                class="required">*</span></label>
                                                        <input type="email" name="customer[email]" placeholder=""
                                                            id="CustomerEmail" autofocus="" class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <label for="CustomerPassword" class="form-label">Password <span
                                                                class="required">*</span></label>
                                                        <input type="password" value="" name="customer[password]"
                                                            placeholder="" id="CustomerPassword" class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="remember-me customCheckbox">
                                                            <input id="remember" name="remember" type="checkbox"
                                                                value="remember me" required />
                                                            <label for="remember"> Remember me</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                        <input type="submit" class="btn" value="Sign In">
                                                        <a href="forgot-password.html" class="btn-link">Forgot your
                                                            password?</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="steps2">
                            <!--Shipping Address-->
                            <div class="block shipping-address mb-4">
                                <div class="block-content">
                                    <h3 class="title mb-3">Shipping Address</h3>
                                    <fieldset>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="firstname" class="form-label">First Name <span
                                                        class="required">*</span></label>
                                                <input name="firstname" value="" id="firstname" type="text"
                                                    required="" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="lastname" class="form-label">Last Name <span
                                                        class="required">*</span></label>
                                                <input name="lastname" value="" id="lastname" type="text"
                                                    required="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="email" class="form-label">E-Mail <span
                                                        class="required">*</span></label>
                                                <input name="email" value="" id="email" type="email"
                                                    required="" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="phone" class="form-label">Phone <span
                                                        class="required">*</span></label>
                                                <input name="phone" value="" id="phone" type="tel"
                                                    required="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address-1" class="form-label">Address <span
                                                        class="required">*</span></label>
                                                <input name="address_1" value="" id="address-1" type="text"
                                                    required="" placeholder="Street address" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address-1" class="form-label d-none d-sm-block">&nbsp;</label>
                                                <input name="address_2" value="" id="address-2" type="text"
                                                    required="" placeholder="Apartment, suite, unit etc. (optional)"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="postcode" class="form-label">Postcode / ZIP <span
                                                        class="required">*</span></label>
                                                <input name="postcode" value="" id="postcode" type="text"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address_country1" class="form-label">Country <span
                                                        class="required">*</span></label>
                                                <select id="address_country1" name="address[country]"
                                                    data-default="United States" class="form-control">
                                                    <option value="0" label="Select a country" selected="selected">
                                                        Select a country</option>
                                                    <optgroup id="country-optgroup-Africa" label="Africa">
                                                        <option value="DZ" label="Algeria">Algeria</option>
                                                        <option value="AO" label="Angola">Angola</option>
                                                        <option value="BJ" label="Benin">Benin</option>
                                                        <option value="BW" label="Botswana">Botswana</option>
                                                        <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                                        <option value="BI" label="Burundi">Burundi</option>
                                                        <option value="CM" label="Cameroon">Cameroon</option>
                                                        <option value="CV" label="Cape Verde">Cape Verde</option>
                                                        <option value="CF" label="Central African Republic">Central
                                                            African Republic</option>
                                                        <option value="TD" label="Chad">Chad</option>
                                                        <option value="KM" label="Comoros">Comoros</option>
                                                        <option value="CG" label="Congo - Brazzaville">Congo -
                                                            Brazzaville</option>
                                                        <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa
                                                        </option>
                                                        <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire
                                                        </option>
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
                                                        <option value="GW" label="Guinea-Bissau">Guinea-Bissau
                                                        </option>
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
                                                        <option value="ST" label="São Tomé and Príncipe">São Tomé and
                                                            Príncipe</option>
                                                        <option value="TZ" label="Tanzania">Tanzania</option>
                                                        <option value="TG" label="Togo">Togo</option>
                                                        <option value="TN" label="Tunisia">Tunisia</option>
                                                        <option value="UG" label="Uganda">Uganda</option>
                                                        <option value="EH" label="Western Sahara">Western Sahara
                                                        </option>
                                                        <option value="ZM" label="Zambia">Zambia</option>
                                                        <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                                    </optgroup>
                                                    <optgroup id="country-optgroup-Americas" label="Americas">
                                                        <option value="AI" label="Anguilla">Anguilla</option>
                                                        <option value="AG" label="Antigua and Barbuda">Antigua and
                                                            Barbuda</option>
                                                        <option value="AR" label="Argentina">Argentina</option>
                                                        <option value="AW" label="Aruba">Aruba</option>
                                                        <option value="BS" label="Bahamas">Bahamas</option>
                                                        <option value="BB" label="Barbados">Barbados</option>
                                                        <option value="BZ" label="Belize">Belize</option>
                                                        <option value="BM" label="Bermuda">Bermuda</option>
                                                        <option value="BO" label="Bolivia">Bolivia</option>
                                                        <option value="BR" label="Brazil">Brazil</option>
                                                        <option value="VG" label="British Virgin Islands">British
                                                            Virgin Islands</option>
                                                        <option value="CA" label="Canada">Canada</option>
                                                        <option value="KY" label="Cayman Islands">Cayman Islands
                                                        </option>
                                                        <option value="CL" label="Chile">Chile</option>
                                                        <option value="CO" label="Colombia">Colombia</option>
                                                        <option value="CR" label="Costa Rica">Costa Rica</option>
                                                        <option value="CU" label="Cuba">Cuba</option>
                                                        <option value="DM" label="Dominica">Dominica</option>
                                                        <option value="DO" label="Dominican Republic">Dominican
                                                            Republic</option>
                                                        <option value="EC" label="Ecuador">Ecuador</option>
                                                        <option value="SV" label="El Salvador">El Salvador</option>
                                                        <option value="FK" label="Falkland Islands">Falkland Islands
                                                        </option>
                                                        <option value="GF" label="French Guiana">French Guiana
                                                        </option>
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
                                                        <option value="AN" label="Netherlands Antilles">Netherlands
                                                            Antilles</option>
                                                        <option value="NI" label="Nicaragua">Nicaragua</option>
                                                        <option value="PA" label="Panama">Panama</option>
                                                        <option value="PY" label="Paraguay">Paraguay</option>
                                                        <option value="PE" label="Peru">Peru</option>
                                                        <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                                        <option value="BL" label="Saint Barthélemy">Saint Barthélemy
                                                        </option>
                                                        <option value="KN" label="Saint Kitts and Nevis">Saint Kitts
                                                            and Nevis</option>
                                                        <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                                        <option value="MF" label="Saint Martin">Saint Martin</option>
                                                        <option value="PM" label="Saint Pierre and Miquelon">Saint
                                                            Pierre and Miquelon</option>
                                                        <option value="VC" label="Saint Vincent and the Grenadines">
                                                            Saint Vincent and the Grenadines</option>
                                                        <option value="SR" label="Suriname">Suriname</option>
                                                        <option value="TT" label="Trinidad and Tobago">Trinidad and
                                                            Tobago</option>
                                                        <option value="TC" label="Turks and Caicos Islands">Turks and
                                                            Caicos Islands</option>
                                                        <option value="VI" label="U.S. Virgin Islands">U.S. Virgin
                                                            Islands</option>
                                                        <option value="US" label="United States">United States
                                                        </option>
                                                        <option value="UY" label="Uruguay">Uruguay</option>
                                                        <option value="VE" label="Venezuela">Venezuela</option>
                                                    </optgroup>
                                                    <optgroup id="country-optgroup-As" label="Asia">
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
                                                        <option value="HK" label="Hong Kong SAR China">Hong Kong SAR
                                                            China</option>
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
                                                        <option value="MO" label="Macau SAR China">Macau SAR China
                                                        </option>
                                                        <option value="MY" label="Malaysia">Malaysia</option>
                                                        <option value="MV" label="Maldives">Maldives</option>
                                                        <option value="MN" label="Mongolia">Mongolia</option>
                                                        <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]
                                                        </option>
                                                        <option value="NP" label="Nepal">Nepal</option>
                                                        <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                                        <option value="KP" label="North Korea">North Korea</option>
                                                        <option value="OM" label="Oman">Oman</option>
                                                        <option value="PK" label="Pakistan">Pakistan</option>
                                                        <option value="PS" label="Palestinian Territories">Palestinian
                                                            Territories</option>
                                                        <option value="YD"
                                                            label="People's Democratic Republic of Yemen">People's
                                                            Democratic Republic of Yemen</option>
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
                                                        <option value="AE" label="United Arab Emirates">United Arab
                                                            Emirates</option>
                                                        <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                                        <option value="VN" label="Vietnam">Vietnam</option>
                                                        <option value="YE" label="Yemen">Yemen</option>
                                                    </optgroup>
                                                    <optgroup id="country-optgroup-Eu" label="Europe">
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
                                                        <option value="CZ" label="Czech Republic">Czech Republic
                                                        </option>
                                                        <option value="DK" label="Denmark">Denmark</option>
                                                        <option value="DD" label="East Germany">East Germany</option>
                                                        <option value="EE" label="Estonia">Estonia</option>
                                                        <option value="FO" label="Faroe Islands">Faroe Islands
                                                        </option>
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
                                                        <option value="LI" label="Liechtenstein">Liechtenstein
                                                        </option>
                                                        <option value="LT" label="Lithuania">Lithuania</option>
                                                        <option value="LU" label="Luxembourg">Luxembourg</option>
                                                        <option value="MK" label="Macedonia">Macedonia</option>
                                                        <option value="MT" label="Malta">Malta</option>
                                                        <option value="FX" label="Metropolitan France">Metropolitan
                                                            France</option>
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
                                                        <option value="CS" label="Serbia and Montenegro">Serbia and
                                                            Montenegro</option>
                                                        <option value="SK" label="Slovakia">Slovakia</option>
                                                        <option value="SI" label="Slovenia">Slovenia</option>
                                                        <option value="ES" label="Spain">Spain</option>
                                                        <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and
                                                            Jan Mayen</option>
                                                        <option value="SE" label="Sweden">Sweden</option>
                                                        <option value="CH" label="Switzerland">Switzerland</option>
                                                        <option value="UA" label="Ukraine">Ukraine</option>
                                                        <option value="SU"
                                                            label="Union of Soviet Socialist Republics">Union of Soviet
                                                            Socialist Republics</option>
                                                        <option value="GB" label="United Kingdom">United Kingdom
                                                        </option>
                                                        <option value="VA" label="Vatican City">Vatican City</option>
                                                        <option value="AX" label="Åland Islands">Åland Islands
                                                        </option>
                                                    </optgroup>
                                                    <optgroup id="country-optgroup-Oceania" label="Oceania">
                                                        <option value="AS" label="American Samoa">American Samoa
                                                        </option>
                                                        <option value="AQ" label="Antarctica">Antarctica</option>
                                                        <option value="AU" label="Australia">Australia</option>
                                                        <option value="BV" label="Bouvet Island">Bouvet Island
                                                        </option>
                                                        <option value="IO" label="British Indian Ocean Territory">
                                                            British Indian Ocean Territory</option>
                                                        <option value="CX" label="Christmas Island">Christmas Island
                                                        </option>
                                                        <option value="CC" label="Cocos [Keeling] Islands">Cocos
                                                            [Keeling] Islands</option>
                                                        <option value="CK" label="Cook Islands">Cook Islands</option>
                                                        <option value="FJ" label="Fiji">Fiji</option>
                                                        <option value="PF" label="French Polynesia">French Polynesia
                                                        </option>
                                                        <option value="TF" label="French Southern Territories">French
                                                            Southern Territories</option>
                                                        <option value="GU" label="Guam">Guam</option>
                                                        <option value="HM" label="Heard Island and McDonald Islands">
                                                            Heard Island and McDonald Islands</option>
                                                        <option value="KI" label="Kiribati">Kiribati</option>
                                                        <option value="MH" label="Marshall Islands">Marshall Islands
                                                        </option>
                                                        <option value="FM" label="Micronesia">Micronesia</option>
                                                        <option value="NR" label="Nauru">Nauru</option>
                                                        <option value="NC" label="New Caledonia">New Caledonia
                                                        </option>
                                                        <option value="NZ" label="New Zealand">New Zealand</option>
                                                        <option value="NU" label="Niue">Niue</option>
                                                        <option value="NF" label="Norfolk Island">Norfolk Island
                                                        </option>
                                                        <option value="MP" label="Northern Mariana Islands">Northern
                                                            Mariana Islands</option>
                                                        <option value="PW" label="Palau">Palau</option>
                                                        <option value="PG" label="Papua New Guinea">Papua New Guinea
                                                        </option>
                                                        <option value="PN" label="Pitcairn Islands">Pitcairn Islands
                                                        </option>
                                                        <option value="WS" label="Samoa">Samoa</option>
                                                        <option value="SB" label="Solomon Islands">Solomon Islands
                                                        </option>
                                                        <option value="GS"
                                                            label="South Georgia and the South Sandwich Islands">South
                                                            Georgia and the South Sandwich Islands</option>
                                                        <option value="TK" label="Tokelau">Tokelau</option>
                                                        <option value="TO" label="Tonga">Tonga</option>
                                                        <option value="TV" label="Tuvalu">Tuvalu</option>
                                                        <option value="UM" label="U.S. Minor Outlying Islands">U.S.
                                                            Minor Outlying Islands</option>
                                                        <option value="VU" label="Vanuatu">Vanuatu</option>
                                                        <option value="WF" label="Wallis and Futuna">Wallis and Futuna
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address_State" class="form-label">State <span
                                                        class="required">*</span></label>
                                                <select id="address_State" name="address[State]" data-default=""
                                                    class="form-control">
                                                    <option value="0" label="Select a state" selected="selected">
                                                        Select a state</option>
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
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address_province" class="form-label">Town / City <span
                                                        class="required">*</span></label>
                                                <select id="address_province" name="address[province]" data-default=""
                                                    class="form-control">
                                                    <option value="0" label="Select a city" selected="selected">
                                                        Select a city</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12 mb-0">
                                                <div class="checkout-tearm customCheckbox">
                                                    <input id="checkout_tearm" name="tearm" type="checkbox"
                                                        value="checkout tearm" required />
                                                    <label for="checkout_tearm"> Save address to my account</label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!--End Shipping Address-->
                            <!--Billing Address-->
                            <div class="block billing-address mb-4">
                                <div class="block-content">
                                    <h3 class="title mb-3">Billing Address</h3>
                                    <fieldset>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12">
                                                <div class="checkout-tearm customCheckbox">
                                                    <input id="add_tearm" name="tearm" type="checkbox"
                                                        value="checkout tearm" required />
                                                    <label for="add_tearm"> The same as shipping address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address-11" class="form-label">Address <span
                                                        class="required">*</span></label>
                                                <input name="address_11" value="" id="address-11" type="text"
                                                    required="" placeholder="Street address" class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address-12"
                                                    class="form-label d-none d-sm-block">&nbsp;</label>
                                                <input name="address_12" value="" id="address-12" type="text"
                                                    required="" placeholder="Apartment, suite, unit etc. (optional)"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="postcode2" class="form-label">Postcode / ZIP <span
                                                        class="required">*</span></label>
                                                <input name="postcode2" value="" id="postcode2" type="text"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                <label for="address_country2" class="form-label">Country <span
                                                        class="required">*</span></label>
                                                <select id="address_country2" name="address[country1]"
                                                    data-default="United States" class="form-control">
                                                    <option value="0" label="Select a country" selected="selected">
                                                        Select a country</option>
                                                    <optgroup id="country-optgroup-Af" label="Africa">
                                                        <option value="DZ" label="Algeria">Algeria</option>
                                                        <option value="AO" label="Angola">Angola</option>
                                                        <option value="BJ" label="Benin">Benin</option>
                                                        <option value="BW" label="Botswana">Botswana</option>
                                                        <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                                        <option value="BI" label="Burundi">Burundi</option>
                                                        <option value="CM" label="Cameroon">Cameroon</option>
                                                        <option value="CV" label="Cape Verde">Cape Verde</option>
                                                        <option value="CF" label="Central African Republic">Central
                                                            African Republic</option>
                                                        <option value="TD" label="Chad">Chad</option>
                                                        <option value="KM" label="Comoros">Comoros</option>
                                                        <option value="CG" label="Congo - Brazzaville">Congo -
                                                            Brazzaville</option>
                                                        <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa
                                                        </option>
                                                        <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire
                                                        </option>
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
                                                        <option value="GW" label="Guinea-Bissau">Guinea-Bissau
                                                        </option>
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
                                                        <option value="ST" label="São Tomé and Príncipe">São Tomé and
                                                            Príncipe</option>
                                                        <option value="TZ" label="Tanzania">Tanzania</option>
                                                        <option value="TG" label="Togo">Togo</option>
                                                        <option value="TN" label="Tunisia">Tunisia</option>
                                                        <option value="UG" label="Uganda">Uganda</option>
                                                        <option value="EH" label="Western Sahara">Western Sahara
                                                        </option>
                                                        <option value="ZM" label="Zambia">Zambia</option>
                                                        <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                                    </optgroup>
                                                    <optgroup id="country-optgroup-Am" label="Americas">
                                                        <option value="AI" label="Anguilla">Anguilla</option>
                                                        <option value="AG" label="Antigua and Barbuda">Antigua and
                                                            Barbuda</option>
                                                        <option value="AR" label="Argentina">Argentina</option>
                                                        <option value="AW" label="Aruba">Aruba</option>
                                                        <option value="BS" label="Bahamas">Bahamas</option>
                                                        <option value="BB" label="Barbados">Barbados</option>
                                                        <option value="BZ" label="Belize">Belize</option>
                                                        <option value="BM" label="Bermuda">Bermuda</option>
                                                        <option value="BO" label="Bolivia">Bolivia</option>
                                                        <option value="BR" label="Brazil">Brazil</option>
                                                        <option value="VG" label="British Virgin Islands">British
                                                            Virgin Islands</option>
                                                        <option value="CA" label="Canada">Canada</option>
                                                        <option value="KY" label="Cayman Islands">Cayman Islands
                                                        </option>
                                                        <option value="CL" label="Chile">Chile</option>
                                                        <option value="CO" label="Colombia">Colombia</option>
                                                        <option value="CR" label="Costa Rica">Costa Rica</option>
                                                        <option value="CU" label="Cuba">Cuba</option>
                                                        <option value="DM" label="Dominica">Dominica</option>
                                                        <option value="DO" label="Dominican Republic">Dominican
                                                            Republic</option>
                                                        <option value="EC" label="Ecuador">Ecuador</option>
                                                        <option value="SV" label="El Salvador">El Salvador</option>
                                                        <option value="FK" label="Falkland Islands">Falkland Islands
                                                        </option>
                                                        <option value="GF" label="French Guiana">French Guiana
                                                        </option>
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
                                                        <option value="AN" label="Netherlands Antilles">Netherlands
                                                            Antilles</option>
                                                        <option value="NI" label="Nicaragua">Nicaragua</option>
                                                        <option value="PA" label="Panama">Panama</option>
                                                        <option value="PY" label="Paraguay">Paraguay</option>
                                                        <option value="PE" label="Peru">Peru</option>
                                                        <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                                        <option value="BL" label="Saint Barthélemy">Saint Barthélemy
                                                        </option>
                                                        <option value="KN" label="Saint Kitts and Nevis">Saint Kitts
                                                            and Nevis</option>
                                                        <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                                        <option value="MF" label="Saint Martin">Saint Martin
                                                        </option>
                                                        <option value="PM" label="Saint Pierre and Miquelon">Saint
                                                            Pierre and Miquelon</option>
                                                        <option value="VC" label="Saint Vincent and the Grenadines">
                                                            Saint Vincent and the Grenadines</option>
                                                        <option value="SR" label="Suriname">Suriname</option>
                                                        <option value="TT" label="Trinidad and Tobago">Trinidad and
                                                            Tobago</option>
                                                        <option value="TC" label="Turks and Caicos Islands">Turks
                                                            and Caicos Islands</option>
                                                        <option value="VI" label="U.S. Virgin Islands">U.S. Virgin
                                                            Islands</option>
                                                        <option value="US" label="United States">United States
                                                        </option>
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
                                                        <option value="HK" label="Hong Kong SAR China">Hong Kong SAR
                                                            China</option>
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
                                                        <option value="MO" label="Macau SAR China">Macau SAR China
                                                        </option>
                                                        <option value="MY" label="Malaysia">Malaysia</option>
                                                        <option value="MV" label="Maldives">Maldives</option>
                                                        <option value="MN" label="Mongolia">Mongolia</option>
                                                        <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]
                                                        </option>
                                                        <option value="NP" label="Nepal">Nepal</option>
                                                        <option value="NT" label="Neutral Zone">Neutral Zone
                                                        </option>
                                                        <option value="KP" label="North Korea">North Korea</option>
                                                        <option value="OM" label="Oman">Oman</option>
                                                        <option value="PK" label="Pakistan">Pakistan</option>
                                                        <option value="PS" label="Palestinian Territories">
                                                            Palestinian Territories</option>
                                                        <option value="YD"
                                                            label="People's Democratic Republic of Yemen">People's
                                                            Democratic Republic of Yemen</option>
                                                        <option value="PH" label="Philippines">Philippines</option>
                                                        <option value="QA" label="Qatar">Qatar</option>
                                                        <option value="SA" label="Saudi Arabia">Saudi Arabia
                                                        </option>
                                                        <option value="SG" label="Singapore">Singapore</option>
                                                        <option value="KR" label="South Korea">South Korea</option>
                                                        <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                                        <option value="SY" label="Syria">Syria</option>
                                                        <option value="TW" label="Taiwan">Taiwan</option>
                                                        <option value="TJ" label="Tajikistan">Tajikistan</option>
                                                        <option value="TH" label="Thailand">Thailand</option>
                                                        <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                                        <option value="TR" label="Turkey">Turkey</option>
                                                        <option value="TM" label="Turkmenistan">Turkmenistan
                                                        </option>
                                                        <option value="AE" label="United Arab Emirates">United Arab
                                                            Emirates</option>
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
                                                        <option value="CZ" label="Czech Republic">Czech Republic
                                                        </option>
                                                        <option value="DK" label="Denmark">Denmark</option>
                                                        <option value="DD" label="East Germany">East Germany
                                                        </option>
                                                        <option value="EE" label="Estonia">Estonia</option>
                                                        <option value="FO" label="Faroe Islands">Faroe Islands
                                                        </option>
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
                                                        <option value="LI" label="Liechtenstein">Liechtenstein
                                                        </option>
                                                        <option value="LT" label="Lithuania">Lithuania</option>
                                                        <option value="LU" label="Luxembourg">Luxembourg</option>
                                                        <option value="MK" label="Macedonia">Macedonia</option>
                                                        <option value="MT" label="Malta">Malta</option>
                                                        <option value="FX" label="Metropolitan France">Metropolitan
                                                            France</option>
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
                                                        <option value="CS" label="Serbia and Montenegro">Serbia and
                                                            Montenegro</option>
                                                        <option value="SK" label="Slovakia">Slovakia</option>
                                                        <option value="SI" label="Slovenia">Slovenia</option>
                                                        <option value="ES" label="Spain">Spain</option>
                                                        <option value="SJ" label="Svalbard and Jan Mayen">Svalbard
                                                            and Jan Mayen</option>
                                                        <option value="SE" label="Sweden">Sweden</option>
                                                        <option value="CH" label="Switzerland">Switzerland</option>
                                                        <option value="UA" label="Ukraine">Ukraine</option>
                                                        <option value="SU"
                                                            label="Union of Soviet Socialist Republics">Union of Soviet
                                                            Socialist Republics</option>
                                                        <option value="GB" label="United Kingdom">United Kingdom
                                                        </option>
                                                        <option value="VA" label="Vatican City">Vatican City
                                                        </option>
                                                        <option value="AX" label="Åland Islands">Åland Islands
                                                        </option>
                                                    </optgroup>
                                                    <optgroup id="country-optgroup-Oc" label="Oceania">
                                                        <option value="AS" label="American Samoa">American Samoa
                                                        </option>
                                                        <option value="AQ" label="Antarctica">Antarctica</option>
                                                        <option value="AU" label="Australia">Australia</option>
                                                        <option value="BV" label="Bouvet Island">Bouvet Island
                                                        </option>
                                                        <option value="IO" label="British Indian Ocean Territory">
                                                            British Indian Ocean Territory</option>
                                                        <option value="CX" label="Christmas Island">Christmas Island
                                                        </option>
                                                        <option value="CC" label="Cocos [Keeling] Islands">Cocos
                                                            [Keeling] Islands</option>
                                                        <option value="CK" label="Cook Islands">Cook Islands
                                                        </option>
                                                        <option value="FJ" label="Fiji">Fiji</option>
                                                        <option value="PF" label="French Polynesia">French Polynesia
                                                        </option>
                                                        <option value="TF" label="French Southern Territories">
                                                            French Southern Territories</option>
                                                        <option value="GU" label="Guam">Guam</option>
                                                        <option value="HM"
                                                            label="Heard Island and McDonald Islands">Heard Island and
                                                            McDonald Islands</option>
                                                        <option value="KI" label="Kiribati">Kiribati</option>
                                                        <option value="MH" label="Marshall Islands">Marshall Islands
                                                        </option>
                                                        <option value="FM" label="Micronesia">Micronesia</option>
                                                        <option value="NR" label="Nauru">Nauru</option>
                                                        <option value="NC" label="New Caledonia">New Caledonia
                                                        </option>
                                                        <option value="NZ" label="New Zealand">New Zealand</option>
                                                        <option value="NU" label="Niue">Niue</option>
                                                        <option value="NF" label="Norfolk Island">Norfolk Island
                                                        </option>
                                                        <option value="MP" label="Northern Mariana Islands">Northern
                                                            Mariana Islands</option>
                                                        <option value="PW" label="Palau">Palau</option>
                                                        <option value="PG" label="Papua New Guinea">Papua New Guinea
                                                        </option>
                                                        <option value="PN" label="Pitcairn Islands">Pitcairn Islands
                                                        </option>
                                                        <option value="WS" label="Samoa">Samoa</option>
                                                        <option value="SB" label="Solomon Islands">Solomon Islands
                                                        </option>
                                                        <option value="GS"
                                                            label="South Georgia and the South Sandwich Islands">South
                                                            Georgia and the South Sandwich Islands</option>
                                                        <option value="TK" label="Tokelau">Tokelau</option>
                                                        <option value="TO" label="Tonga">Tonga</option>
                                                        <option value="TV" label="Tuvalu">Tuvalu</option>
                                                        <option value="UM" label="U.S. Minor Outlying Islands">U.S.
                                                            Minor Outlying Islands</option>
                                                        <option value="VU" label="Vanuatu">Vanuatu</option>
                                                        <option value="WF" label="Wallis and Futuna">Wallis and
                                                            Futuna</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-sm-0">
                                                <label for="address_State1" class="form-label">State <span
                                                        class="required">*</span></label>
                                                <select id="address_State1" name="address[State]" data-default=""
                                                    class="form-control">
                                                    <option value="0" label="Select a state" selected="selected">
                                                        Select a state</option>
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
                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-0">
                                                <label for="address_province2" class="form-label">Town / City <span
                                                        class="required">*</span></label>
                                                <select id="address_province2" name="address[province]"
                                                    data-default="" class="form-control">
                                                    <option value="0" label="Select a city" selected="selected">
                                                        Select a city</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!--End Billing Address-->

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary btnPrevious me-1">Back to Checkout
                                    Method</button>
                                <button type="button" class="btn btn-primary btnNext ms-1">Next Order Summary</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="steps3">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                                    <!--Order Summary-->
                                    <div class="block order-summary">
                                        <div class="block-content">
                                            <h3 class="title mb-3">Order Summary</h3>
                                            <div class="table-responsive table-bottom-brd order-table">
                                                <table class="table table-hover align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="action">&nbsp;</th>
                                                            <th class="text-start">Image</th>
                                                            <th class="text-start proName">Product</th>
                                                            <th class="text-center">Qty</th>
                                                            <th class="text-center">Price</th>
                                                            <th class="text-center">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center cart-delete"><a href="#"
                                                                    class="btn btn-secondary cart-remove remove-icon position-static"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Remove to Cart"><i
                                                                        class="icon anm anm-times-r"></i></a></td>
                                                            <td class="text-start"><a href="product-layout1.html"
                                                                    class="thumb"><img
                                                                        class="rounded-0 blur-up lazyload"
                                                                        data-src="assets/images/products/product1-120x170.jpg"
                                                                        src="assets/images/products/product1-120x170.jpg"
                                                                        alt="product" title="product" width="120"
                                                                        height="170" /></a></td>
                                                            <td class="text-start proName">
                                                                <div class="list-view-item-title">
                                                                    <a href="product-layout1.html">Oxford Cuban Shirt</a>
                                                                </div>
                                                                <div class="cart-meta-text">
                                                                    Color: Black<br>Size: Small
                                                                </div>
                                                            </td>
                                                            <td class="text-center">2</td>
                                                            <td class="text-center">$99.00</td>
                                                            <td class="text-center"><strong>$198.00</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center cart-delete"><a href="#"
                                                                    class="btn btn-secondary cart-remove remove-icon position-static"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Remove to Cart"><i
                                                                        class="icon anm anm-times-r"></i></a></td>
                                                            <td class="text-start"><a href="product-layout1.html"
                                                                    class="thumb"><img
                                                                        class="rounded-0 blur-up lazyload"
                                                                        data-src="assets/images/products/product2-120x170.jpg"
                                                                        src="assets/images/products/product2-120x170.jpg"
                                                                        alt="product" title="product" width="120"
                                                                        height="170" /></a></td>
                                                            <td class="text-start proName">
                                                                <div class="list-view-item-title">
                                                                    <a href="product-layout1.html">Cuff Beanie Cap</a>
                                                                </div>
                                                                <div class="cart-meta-text">
                                                                    Color: Black<br>Size: Small
                                                                </div>
                                                            </td>
                                                            <td class="text-center">1</td>
                                                            <td class="text-center">$128.00</td>
                                                            <td class="text-center"><strong>$128.00</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Order Summary-->
                                    <!--Order Comment-->
                                    <div class="block order-comments my-4">
                                        <div class="block-content">
                                            <h3 class="title mb-3">Order Comment</h3>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-lg-12 col-xl-12 mb-0">
                                                        <textarea class="resize-both form-control" rows="3" placeholder="Place your comment here"></textarea>
                                                        <small class="mt-2 d-block">*Savings include promotions, coupons,
                                                            rueBUCKS, and shipping (if applicable).</small>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!--End Order Comment-->
                                </div>
                                <div class="col-12 col-sm-12 col-md-5 col-lg-4">
                                    <!--Apply Promocode-->
                                    <div class="block mb-3 apply-code mb-4">
                                        <div class="block-content">
                                            <h3 class="title mb-3">Apply Promocode</h3>
                                            <div id="coupon" class="coupon-dec">
                                                <p>Got a promo code? Then you're a few randomly combined numbers & letters
                                                    away from fab savings!</p>
                                                <div class="input-group mb-0 d-flex">
                                                    <input id="coupon-code" required="" type="text"
                                                        class="form-control" placeholder="Promotion/Discount Code">
                                                    <button class="coupon-btn btn btn-primary"
                                                        type="submit">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Apply Promocode-->
                                    <!--Cart Summary-->
                                    <div class="cart-info mb-4">
                                        <div class="cart-order-detail cart-col">
                                            <div class="row g-0 border-bottom pb-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">$326.00</span></span>
                                            </div>
                                            <div class="row g-0 border-bottom py-2">
                                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Coupon
                                                        Discount</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">-$25.00</span></span>
                                            </div>
                                            <div class="row g-0 border-bottom py-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">$10.00</span></span>
                                            </div>
                                            <div class="row g-0 border-bottom py-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">Free shipping</span></span>
                                            </div>
                                            <div class="row g-0 pt-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                                        class="money">$311.00</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Cart Summary-->
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary me-1 btnPrevious">Back to Order
                                    Summary</button>
                                <button type="button" class="btn btn-primary ms-1 btnNext">Next Proceed to
                                    Payment</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="steps4">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                                    <!--Delivery Methods-->
                                    <div class="block mb-3 delivery-methods mb-4">
                                        <div class="block-content">
                                            <h3 class="title mb-3">Delivery Methods</h3>
                                            <div class="delivery-methods-content">
                                                <div class="customRadio clearfix">
                                                    <input id="formcheckoutRadio1" value="" name="radio1"
                                                        type="radio" class="radio" checked="checked">
                                                    <label for="formcheckoutRadio1" class="mb-0">Standard Delivery
                                                        $2.99 (3-5 days)</label>
                                                </div>
                                                <div class="customRadio clearfix">
                                                    <input id="formcheckoutRadio2" value="" name="radio1"
                                                        type="radio" class="radio">
                                                    <label for="formcheckoutRadio2" class="mb-0">Express Delivery
                                                        $10.99 (1-2 days)</label>
                                                </div>
                                                <div class="customRadio clearfix mb-0">
                                                    <input id="formcheckoutRadio3" value="" name="radio1"
                                                        type="radio" class="radio">
                                                    <label for="formcheckoutRadio3" class="mb-0">Same-Day $20.00
                                                        (Evening Delivery)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Delivery Methods-->
                                    <!--Payment Methods-->
                                    <div class="block mb-3 payment-methods mb-4">
                                        <div class="block-content">
                                            <h3 class="title mb-3">Payment Methods</h3>
                                            <div class="payment-accordion-radio">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item card mb-2">
                                                        <div class="card-header" id="headingOne">
                                                            <button class="card-link" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                <span class="customRadio clearfix mb-0">
                                                                    <input id="paymentRadio1" value=""
                                                                        name="payment" type="radio" class="radio"
                                                                        checked="checked" />
                                                                    <label for="paymentRadio1" class="mb-0">Pay with
                                                                        credit card</label>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="card-body px-0">
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div
                                                                            class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                                            <label for="input-cardname">Name on Card <span
                                                                                    class="required">*</span></label>
                                                                            <input name="cardname" value=""
                                                                                placeholder="" id="input-cardname"
                                                                                class="form-control" type="text"
                                                                                pattern="[0-9\-]*">
                                                                        </div>
                                                                        <div
                                                                            class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                                            <label>Credit Card Type <span
                                                                                    class="required">*</span></label>
                                                                            <select name="country_id"
                                                                                class="form-control">
                                                                                <option value="">Please Select
                                                                                </option>
                                                                                <option value="1">American Express
                                                                                </option>
                                                                                <option value="2">Visa Card</option>
                                                                                <option value="3">Master Card
                                                                                </option>
                                                                                <option value="4">Discover Card
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div
                                                                            class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                                                            <label for="input-cardno">Credit Card Number
                                                                                <span class="required">*</span></label>
                                                                            <input name="cardno" value=""
                                                                                placeholder="" id="input-cardno"
                                                                                class="form-control" type="text"
                                                                                pattern="[0-9\-]*">
                                                                        </div>
                                                                        <div
                                                                            class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                                                            <label for="input-cvv">CVV Code <span
                                                                                    class="required">*</span></label>
                                                                            <input name="cvv" value=""
                                                                                placeholder="" id="input-cvv"
                                                                                class="form-control" type="text"
                                                                                pattern="[0-9\-]*">
                                                                        </div>
                                                                        <div
                                                                            class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                                                            <label>Expiration Date <span
                                                                                    class="required">*</span></label>
                                                                            <input type="date" name="exdate"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div
                                                                            class="form-group col-12 col-sm-4 col-md-4 col-lg-4 mb-0">
                                                                            <button class="btn btn-primary"
                                                                                type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item card mb-2">
                                                        <div class="card-header" id="headingTwo">
                                                            <button class="card-link" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                                <span class="customRadio clearfix mb-0">
                                                                    <input id="paymentRadio2" value=""
                                                                        name="payment" type="radio"
                                                                        class="radio" />
                                                                    <label for="paymentRadio2" class="mb-0">Pay with
                                                                        Paypal</label>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="card-body px-0">
                                                                <p>Pay via PayPal you can pay with your credit card if you
                                                                    don't have a PayPal account.</p>
                                                                <div class="input-group mb-0 d-flex">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="paypal@example.com" required="">
                                                                    <button class="btn btn-primary" type="submit">Pay
                                                                        99.00 USD</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item card mb-2">
                                                        <div class="card-header" id="headingThree">
                                                            <button class="card-link" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseThree" aria-expanded="false"
                                                                aria-controls="collapseThree">
                                                                <span class="customRadio clearfix mb-0">
                                                                    <input id="paymentRadio3" value=""
                                                                        name="payment" type="radio"
                                                                        class="radio" />
                                                                    <label for="paymentRadio3" class="mb-0">Cheque
                                                                        Payment</label>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapseThree" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="card-body px-0">
                                                                <p>Please send your cheque to Store Name, Store Street,
                                                                    Store Town, Store State / County, Store Postcode.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item card mb-0">
                                                        <div class="card-header" id="headingFour">
                                                            <button class="card-link" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                                aria-expanded="false" aria-controls="collapseFour">
                                                                <span class="customRadio clearfix mb-0">
                                                                    <input id="paymentRadio4" value=""
                                                                        name="payment" type="radio"
                                                                        class="radio" />
                                                                    <label for="paymentRadio4" class="mb-0">Cash On
                                                                        Delivery</label>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapseFour" class="accordion-collapse collapse"
                                                            aria-labelledby="headingFour"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="card-body px-0">
                                                                <p>Cash on delivery refers to an arrangement in which
                                                                    payment for a purchase is made directly by the purchaser
                                                                    to the person who delivers the item.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Payment Methods-->
                                </div>
                                <div class="col-12 col-sm-12 col-md-5 col-lg-4">
                                    <!--Cart Summary-->
                                    <div class="cart-info">
                                        <div class="cart-order-detail cart-col">
                                            <div class="row g-0 border-bottom pb-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">$226.00</span></span>
                                            </div>
                                            <div class="row g-0 border-bottom py-2">
                                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Coupon
                                                        Discount</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">-$25.00</span></span>
                                            </div>
                                            <div class="row g-0 border-bottom py-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">$10.00</span></span>
                                            </div>
                                            <div class="row g-0 border-bottom py-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                        class="money">Free shipping</span></span>
                                            </div>
                                            <div class="row g-0 pt-2">
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                                <span
                                                    class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                                        class="money">$311.00</b></span>
                                            </div>

                                            <a href="order-success.html" id="cartCheckout"
                                                class="btn btn-lg my-4 checkout w-100">Place order</a>
                                            <div class="paymnet-img text-center"><img
                                                    src="assets/images/icons/safepayment.png" alt="Payment"
                                                    width="299" height="28" /></div>
                                        </div>
                                    </div>
                                    <!--Cart Summary-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Tab checkout content-->
                </div>
            </div>
        </div>
        <!--End Main Content-->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Add active class to the current list tem (highlight it)
            var checkoutList = document.getElementById("nav-tabs");
            var checkoutItems = checkoutList.getElementsByClassName("nav-item");
            for (var i = 0; i < checkoutItems.length; i++) {
                checkoutItems[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("onactive");
                    current[0].className = current[0].className.replace(" onactive", "");
                    this.className += " onactive";
                });
            }

            // Nav next/prev
            $('.btnNext').click(function() {
                const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
                const nextTab = new bootstrap.Tab(nextTabLinkEl);
                nextTab.show();
            });
            $('.btnPrevious').click(function() {
                const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
                const prevTab = new bootstrap.Tab(prevTabLinkEl);
                prevTab.show();
            });
        });
    </script>
@endsection
