@extends('layouts.main', ['title' => $data_msi['no_jurnal'] ." | ". "MSI"])

@section('content')

<div class="rounded-lg mt-7 relative bg-white w-full overflow-hidden h-auto space-y-3">
  <div class="flex items-center py-7 px-10">
      <h1 class="text-3xl font-bold text-yellow-500">Marine Safety Information | {{$data_msi['no_jurnal']}}</h1>
  </div>
  <div class="flex px-10 pb-10">
      <table class="w-full">
          <tbody class="">
              <tr>
                <td colspan="2">
                  <span class="text-lg mb-2 font-bold text-yellow-400">Informasi Kenavigasian</span> 
                  <br>
                  <span class="text-xl font-bold mt-2">{{$data_msi['information']}}</span>
                </td>
              </tr>
              <tr class="">
                  <td class="py-4 px-3 ">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg id="windy-strong" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 50.249 50.251">
                                  <path id="Path_22" data-name="Path 22" d="M20.527,39.822a8.983,8.983,0,0,1-8.973-8.974h3.59a5.383,5.383,0,1,0,5.383-5.383H4.375v-3.59H20.527a8.974,8.974,0,0,1,0,17.947Z" transform="translate(-0.787 10.429)" fill="#171717"/>
                                  <path id="Path_23" data-name="Path 23" d="M43.464,34.353A8.983,8.983,0,0,1,34.49,25.38h3.59A5.383,5.383,0,1,0,43.464,20H2.188v-3.59H43.464a8.974,8.974,0,0,1,0,17.947Z" transform="translate(-2.188 6.925)" fill="#171717"/>
                                  <path id="Path_24" data-name="Path 24" d="M33.482,20.134H6.563v-3.59H33.482A5.383,5.383,0,1,0,28.1,11.161h-3.59a8.973,8.973,0,1,1,8.973,8.974Z" transform="translate(0.615 -2.187)" fill="#171717"/>
                              </svg>                              
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Kecepatan Angin</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['wind_speed_min'].' - '.$data_msi['wind_speed_max']}} m/s</span>
                          </div>
                      </div>
                  </td>
                  <td class="py-4 px-3">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 19.438 44.426">
                                  <g id="Group_2900" data-name="Group 2900" transform="translate(0)">
                                      <path id="Path_28" data-name="Path 28" d="M14.009,5.554a5.554,5.554,0,0,1,11.107,0V26.732a9.718,9.718,0,1,1-11.107,0Zm5.554-2.777a2.777,2.777,0,0,0-2.777,2.777V27.492a1.389,1.389,0,0,1-.694,1.2,6.946,6.946,0,1,0,6.942,0,1.389,1.389,0,0,1-.694-1.2V5.554a2.777,2.777,0,0,0-2.777-2.777Z" transform="translate(-9.844)" fill="#171717" fill-rule="evenodd"/>
                                      <path id="Path_29" data-name="Path 29" d="M22.549,28.228a4.165,4.165,0,1,1-4.165-4.165A4.165,4.165,0,0,1,22.549,28.228Z" transform="translate(-8.665 6.482)" fill="#171717"/>
                                      <path id="Path_30" data-name="Path 30" d="M17.647,3.828a.694.694,0,0,1,.694.694V32.29a.694.694,0,0,1-1.389,0V4.522A.694.694,0,0,1,17.647,3.828Z" transform="translate(-7.928 1.031)" fill="#171717" fill-rule="evenodd"/>
                                  </g>
                                  </svg>                                                                                       
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Temperatur</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['temperature_min'].' - '.$data_msi['temperature_max']}} &deg;</span>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr class="">
                  <td class="py-4 px-3 ">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 51.957 41.606">
                                  <path id="sea" d="M45.485,21.4a19.917,19.917,0,0,0-5.987-.61,33.7,33.7,0,0,0-6.367.834q-3.07.711-6.6,1.587t-6.7,1.648A41.472,41.472,0,0,1,13.116,25.9a28.264,28.264,0,0,1-6.6-.224A15.013,15.013,0,0,1,1.9,24.228q-1.877-1-1.877-2.136t1.929-1.709a10.527,10.527,0,0,1,4.566-.163,13.982,13.982,0,0,0,5.226.651,33.371,33.371,0,0,0,6.14-.834q3.1-.711,6.748-1.587t7.052-1.668a45.607,45.607,0,0,1,7.052-1.058,29.516,29.516,0,0,1,6.748.224A15.013,15.013,0,0,1,50.1,17.391q1.877,1,1.877,2.1,0,1.22-2,1.872A8.094,8.094,0,0,1,45.485,21.4Zm0-15.623a19.917,19.917,0,0,0-5.987-.61A33.7,33.7,0,0,0,33.131,6q-3.07.711-6.6,1.587t-6.7,1.648a41.471,41.471,0,0,1-6.722,1.038,28.264,28.264,0,0,1-6.6-.224A15.013,15.013,0,0,1,1.9,8.605Q.026,7.609.026,6.469T1.955,4.76A10.527,10.527,0,0,1,6.521,4.6a13.982,13.982,0,0,0,5.226.651,33.371,33.371,0,0,0,6.14-.834q3.1-.711,6.748-1.587t7.052-1.668A45.607,45.607,0,0,1,38.739.1a29.516,29.516,0,0,1,6.748.224A15.013,15.013,0,0,1,50.1,1.768q1.877,1,1.877,2.1,0,1.22-2,1.872a8.094,8.094,0,0,1-4.491.041ZM6.518,35.843a13.982,13.982,0,0,0,5.226.651,33.371,33.371,0,0,0,6.14-.834q3.1-.711,6.748-1.587T31.684,32.4a45.607,45.607,0,0,1,7.052-1.058,29.515,29.515,0,0,1,6.748.224A15.013,15.013,0,0,1,50.1,33.014q1.877,1,1.877,2.1,0,1.22-2,1.872a8.094,8.094,0,0,1-4.491.041,19.917,19.917,0,0,0-5.987-.61,33.7,33.7,0,0,0-6.367.834q-3.07.711-6.6,1.587t-6.7,1.648a41.469,41.469,0,0,1-6.722,1.038,28.264,28.264,0,0,1-6.6-.224A15.013,15.013,0,0,1,1.9,39.851q-1.877-1-1.877-2.136t1.929-1.709a10.527,10.527,0,0,1,4.566-.163Z" transform="translate(-0.023 -0.007)" fill="#171717"/>
                                </svg>                                  
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Arus</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">- N</span>
                          </div>
                      </div>
                  </td>
                  <td class="py-4 px-3">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 30.264 42.033">
                                  <path id="humidity" d="M35.358,21.764,24.212,4.016a1.748,1.748,0,0,0-2.848,0l-11.2,17.833a16.789,16.789,0,0,0-2.512,8.333,15.132,15.132,0,1,0,30.264,0,16.918,16.918,0,0,0-2.562-8.418ZM22.788,41.952A11.784,11.784,0,0,1,11.019,30.183a13.413,13.413,0,0,1,2.048-6.63l1.573-2.506L31.576,37.985a11.73,11.73,0,0,1-8.788,3.969Z" transform="translate(-7.656 -3.281)" fill="#171717"/>
                                </svg>
                                                                                                                     
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Kelembapan</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['humidity_min'].' - '.$data_msi['humidity_max']}} %</span>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr class="">
                  <td class="py-4 px-3 ">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 57.635 55.772">
                                  <path id="Icon_weather-rain" data-name="Icon weather-rain" d="M5.568,35.257a13.276,13.276,0,0,1,3-8.535,13.4,13.4,0,0,1,7.59-4.81,16.407,16.407,0,0,1,5.866-9.342A16.106,16.106,0,0,1,32.453,8.928a16.538,16.538,0,0,1,16.07,12.706h.89a13.8,13.8,0,0,1,6.9,1.807,13.557,13.557,0,0,1,6.9,11.816,13.747,13.747,0,0,1-6.561,11.788,13.078,13.078,0,0,1-6.673,1.974c-.361,0-.556-.167-.556-.473v-3.7c0-.334.195-.5.556-.5a8.6,8.6,0,0,0,6.061-2.836,8.87,8.87,0,0,0,2.5-6.283,8.533,8.533,0,0,0-2.725-6.283,8.845,8.845,0,0,0-6.422-2.669H44.909c-.334,0-.5-.167-.5-.473l-.222-1.613a11.332,11.332,0,0,0-3.865-7.535,11.492,11.492,0,0,0-7.924-3.03,11.4,11.4,0,0,0-7.924,3.03,11.177,11.177,0,0,0-3.781,7.535L20.5,25.665a.491.491,0,0,1-.556.528l-1.474.083a9.291,9.291,0,0,0-5.839,2.975,8.492,8.492,0,0,0-2.363,6.005,8.87,8.87,0,0,0,2.5,6.283,8.6,8.6,0,0,0,6.061,2.836c.306,0,.473.167.473.5v3.7a.425.425,0,0,1-.473.473,13.542,13.542,0,0,1-9.453-4.254A13.153,13.153,0,0,1,5.568,35.257Zm14.874,18.6a1.9,1.9,0,0,1,.111-.556l4.532-16.042a2.246,2.246,0,0,1,.89-1.223,2.326,2.326,0,0,1,1.279-.417,3.116,3.116,0,0,1,.667.083,2.091,2.091,0,0,1,1.5,1.029,2.268,2.268,0,0,1,.222,1.863L25.113,54.524a2.188,2.188,0,0,1-2.28,1.779,1.182,1.182,0,0,1-.306-.056,1.8,1.8,0,0,0-.278-.083,2.311,2.311,0,0,1-1.362-.917A2.487,2.487,0,0,1,20.442,53.857Zm7.284,7.813,6.784-24.383a1.832,1.832,0,0,1,.834-1.223,2.519,2.519,0,0,1,1.362-.417,3.451,3.451,0,0,1,.751.083,2.134,2.134,0,0,1,1.362,1.084,2.32,2.32,0,0,1,.195,1.779L32.259,63a2.02,2.02,0,0,1-.806,1.2,2.265,2.265,0,0,1-1.418.5,1.821,1.821,0,0,1-.7-.139,2.551,2.551,0,0,1-1.446-1.084A2.2,2.2,0,0,1,27.727,61.67Zm11.483-7.757a2.964,2.964,0,0,1,.111-.639l4.532-16.042a2.308,2.308,0,0,1,.834-1.223,2.259,2.259,0,0,1,1.279-.417,3.4,3.4,0,0,1,.723.083,2.16,2.16,0,0,1,1.279.862,2.344,2.344,0,0,1,.417,1.307,3.19,3.19,0,0,1-.056.389c-.028.167-.056.278-.056.334L43.741,54.5a2.053,2.053,0,0,1-.778,1.279,2.35,2.35,0,0,1-1.418.473l-.667-.139a2.249,2.249,0,0,1-1.279-.89A2.546,2.546,0,0,1,39.209,53.913Z" transform="translate(-5.568 -8.928)"/>
                                </svg>
                                                             
                          </div>
                          <div>
                              {{-- <span class="text-lg mb-2 font-bold text-yellow-400">Curah Hujan</span>  --}}
                              <span class="text-lg mb-2 font-bold text-yellow-400">Cuaca</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['weather']}}</span>
                          </div>
                      </div>
                  </td>
                  <td class="py-4 px-3">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg id="stream" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 58.942 35.365">
                                  <path id="Path_25" data-name="Path 25" d="M1.094,7.656H42.353v3.93H1.094Z" transform="translate(-1.094 -7.656)" fill="#171717"/>
                                  <path id="Path_26" data-name="Path 26" d="M10.938,16.406H52.2v3.93H10.938Z" transform="translate(6.745 -0.688)" fill="#171717"/>
                                  <path id="Path_27" data-name="Path 27" d="M1.094,25.156H42.353v3.93H1.094Z" transform="translate(-1.094 6.279)" fill="#171717"/>
                                </svg>                                                                                                                         
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Arah Angin</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['wind_from'].' ke '.$data_msi['wind_to']}}</span>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr class="">
                  <td class="py-4 px-3 ">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 51.178 45.073">
                                  <g id="wave" transform="translate(0 -30.542)">
                                    <g id="Group_2776" data-name="Group 2776" transform="translate(0 30.541)">
                                      <path id="Path_641" data-name="Path 641" d="M49.51,65.6c-11.439,0-19.145-4-21.143-10.98-1.441-5.034.618-9.991,3.352-11.7a4.436,4.436,0,0,1,2.616-.667,6.2,6.2,0,0,1,3.555,1.768c2.336,2.109,2.155,6.855,2.035,10-.071,1.855-.114,2.975.269,3.8a2.126,2.126,0,0,0,2.481,1.152c1.649-.361,3.437-2.337,4.562-4.066A15.46,15.46,0,0,0,49.8,46.7a14.67,14.67,0,0,0-5.643-12,21.244,21.244,0,0,0-12.981-4.154,30.089,30.089,0,0,0-20.724,8.288C5.786,43.249.186,51.4.008,65.163c-.044,3.414.13,6.423,0,8.689a1.669,1.669,0,0,0,1.666,1.763H49.51a1.669,1.669,0,0,0,1.669-1.669V67.271A1.669,1.669,0,0,0,49.51,65.6ZM3.393,72.277c.016-2.089-.082-4.472-.048-7.071.292-22.545,16.134-31.442,27.8-31.326,7.657.069,15.362,4.054,15.317,12.8a12.336,12.336,0,0,1-3.223,7.951c.006-.164.012-.326.018-.482.144-3.762.361-9.447-3.133-12.6A9.173,9.173,0,0,0,33.857,38.9,23.253,23.253,0,0,0,21.8,41.949,23.736,23.736,0,0,0,10,62.42a22.916,22.916,0,0,0,2.274,9.856Zm12.653,0a19.9,19.9,0,0,1,2.831-23.814,19.551,19.551,0,0,0-2.062,7.861,19.143,19.143,0,0,0,3.555,12.3,16.919,16.919,0,0,0,3.66,3.658Zm31.8,0H32.851c-9.258-1.342-13.053-8.883-12.7-15.785a15.12,15.12,0,0,1,5.639-11.3,15.586,15.586,0,0,0-.628,10.348,16.328,16.328,0,0,0,7.355,9.4c3.936,2.437,9.086,3.769,15.327,3.968v3.363Z" transform="translate(0 -30.541)"/>
                                    </g>
                                  </g>
                                </svg>                                                              
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Tinggi Gelombang</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['air_pressure']}} Meter</span>
                          </div>
                      </div>
                  </td>
                  <td class="py-4 px-3">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 38.376 26.166">
                                  <path id="Icon_material-visibility" data-name="Icon material-visibility" d="M20.688,6.75A20.631,20.631,0,0,0,1.5,19.833a20.613,20.613,0,0,0,38.376,0A20.631,20.631,0,0,0,20.688,6.75Zm0,21.8a8.722,8.722,0,1,1,8.722-8.722A8.725,8.725,0,0,1,20.688,28.555Zm0-13.955a5.233,5.233,0,1,0,5.233,5.233A5.226,5.226,0,0,0,20.688,14.6Z" transform="translate(-1.5 -6.75)"/>
                                </svg>
                                                                                                              
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Jarak Pandang</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2"> &deg;</span>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr class="">
                  <td class="py-4 px-3 ">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 54.572 51.62">
                                  <g id="tide" transform="translate(0 -13.835)">
                                    <path id="Path_642" data-name="Path 642" d="M8.091,255.932a2.659,2.659,0,0,1,3.343,0l3.418,2.738a5.84,5.84,0,0,0,7.345,0l3.418-2.738a2.659,2.659,0,0,1,3.343,0l3.418,2.738a5.841,5.841,0,0,0,7.345,0l3.418-2.738a2.658,2.658,0,0,1,3.343,0l6.09,4.878,2-2.5-6.09-4.878a5.841,5.841,0,0,0-7.345,0l-3.418,2.738a2.658,2.658,0,0,1-3.343,0l-3.418-2.738a5.841,5.841,0,0,0-7.345,0L20.2,256.172a2.658,2.658,0,0,1-3.343,0l-3.418-2.738a5.841,5.841,0,0,0-7.345,0L0,258.313l2,2.5Z" transform="translate(0 -212.879)"/>
                                    <path id="Path_643" data-name="Path 643" d="M41.137,335.566,37.719,338.3a2.658,2.658,0,0,1-3.343,0l-3.418-2.738a5.841,5.841,0,0,0-7.345,0L20.2,338.3a2.658,2.658,0,0,1-3.343,0l-3.418-2.738a5.84,5.84,0,0,0-7.345,0L0,340.444l2,2.5,6.09-4.878a2.658,2.658,0,0,1,3.343,0l3.418,2.738a5.841,5.841,0,0,0,7.345,0l3.418-2.738a2.658,2.658,0,0,1,3.343,0l3.418,2.738a5.841,5.841,0,0,0,7.345,0l3.418-2.738a2.658,2.658,0,0,1,3.343,0l6.09,4.878,2-2.5-6.09-4.878A5.84,5.84,0,0,0,41.137,335.566Z" transform="translate(0 -286.249)"/>
                                    <path id="Path_644" data-name="Path 644" d="M41.137,417.7l-3.418,2.738a2.658,2.658,0,0,1-3.343,0L30.958,417.7a5.841,5.841,0,0,0-7.345,0L20.2,420.438a2.658,2.658,0,0,1-3.343,0L13.434,417.7a5.84,5.84,0,0,0-7.345,0L0,422.578l2,2.5,6.09-4.878a2.658,2.658,0,0,1,3.343,0l3.418,2.738a5.841,5.841,0,0,0,7.345,0l3.418-2.738a2.658,2.658,0,0,1,3.343,0l3.418,2.738a5.841,5.841,0,0,0,7.345,0l3.418-2.738a2.658,2.658,0,0,1,3.343,0l6.09,4.878,2-2.5-6.09-4.878A5.84,5.84,0,0,0,41.137,417.7Z" transform="translate(0 -359.621)"/>
                                    <path id="Path_645" data-name="Path 645" d="M179.252,19.926V31.674h3.2V20l5.021,5.021,2.263-2.263-8.919-8.919L171.9,22.754l2.263,2.263Z" transform="translate(-153.56 0)"/>
                                  </g>
                                </svg>
                                                                                            
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Pasang Surut</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">{{$data_msi['low_tide'].' - '.$data_msi['high_tide']}} CM</span>
                          </div>
                      </div>
                  </td>
                  <td class="py-4 px-3">
                      <div class="flex items-center space-x-7">
                          <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 31.344 37.585">
                                  <path id="barometer" d="M0,15.672a15.356,15.356,0,0,1,1.245-6.1,15.547,15.547,0,0,1,3.352-5A15.984,15.984,0,0,1,9.6,1.245a15.471,15.471,0,0,1,12.159,0A15.427,15.427,0,0,1,30.1,9.582a15.309,15.309,0,0,1,1.245,6.09,15.014,15.014,0,0,1-3.08,9.281,15.433,15.433,0,0,1-7.936,5.588v7.043H11.257V30.622a15.347,15.347,0,0,1-8.107-5.579A15.069,15.069,0,0,1,0,15.672Zm3.451,0A11.6,11.6,0,0,0,7.064,24.22a11.7,11.7,0,0,0,8.609,3.592,12.244,12.244,0,0,0,10.6-6.05,12.038,12.038,0,0,0,.672-10.816,12.247,12.247,0,0,0-2.619-3.893,12.481,12.481,0,0,0-3.913-2.608,11.991,11.991,0,0,0-9.463,0,12.478,12.478,0,0,0-3.9,2.608,12.255,12.255,0,0,0-2.619,3.893A11.823,11.823,0,0,0,3.451,15.672Zm1.245.762V14.889H9.332v1.545ZM7.024,8.869l1.123-1.1L11.4,11.016l-1.1,1.123Zm5.418,10.555a3.269,3.269,0,0,1,.933-2.328,3.153,3.153,0,0,1,2.278-1.022l5.84-9.612,1.4.742L18.582,17.538A3.4,3.4,0,0,1,18.16,21.8a3.269,3.269,0,0,1-2.387.973,3.322,3.322,0,0,1-3.331-3.35Zm2.809-9.993V4.8h1.485V9.432H15.251Zm6.281,6.983V14.829h4.636v1.585Z" fill="#171717"/>
                                </svg>                                                                         
                          </div>
                          <div>
                              <span class="text-lg mb-2 font-bold text-yellow-400">Tekanan Udara</span> 
                              <br>
                              <span class="text-2xl font-bold mt-2">- Knot</span>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                <td colspan="2">
                  <span class="text-lg mb-2 font-bold text-yellow-400">Informasi Penting Lainnya</span> 
                  <br>
                  <span class="text-xl font-bold mt-2">{{$data_msi['additional_info']}}</span>
                </td>
              </tr>
          </tbody>
      </table>
  </div>
</div>
<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{route('msi.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
</div>

@endsection

@push('securite')
active-menu
@endpush

@push('before_styles')

@endpush

@push('after_styles')

@endpush

@push('before_scripts')

@endpush

@push('after_scripts')
<script>
    function stepper() {
      return {
        step: 1,
        next() {
            this.step > 3 ? null : this.step = this.step + 1;
        },
        prev() {
            this.step < 2 ? null : this.step = this.step - 1;
        },
        idContainsStep() {
          return $el.id.includes(step);
        }
      }
    }
  </script>
<script>
    $(document).ready(function(){
      $("#searchShip").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > 1)
        });
      });
    });

    // $("#searchShip").on("keyup", function() {
    //     var value = $(this).val();

    //     $("#tbody tr").filter(function(index) {
    //         if (index !== 0) {

    //             $row = $(this);

    //             var id = $row.find("td:first").text();

    //             if (id.indexOf(value) !== 0) {
    //                 $row.hide();
    //             }
    //             else {
    //                 $row.show();
    //             }
    //         }
    //     });
    // });
</script>

<script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
</script>

@endpush
