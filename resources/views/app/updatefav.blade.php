<div class="row">
                                   <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('form.nameservice')</th>
                                                        <th>@lang('form.action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($appfav as $key => $fav)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td> @if($user->language == 'en')
                                                                    <?php echo $fav->service_en ;?>
                                                                @else
                                                                    <?php echo $fav->service_bm ;?>
                                                                @endif
                                                        </td>
                                                        <td><a style="cursor:pointer;" class="btn btn-primary btn-sm" href="javascript:removefav('{{$fav->id}}');"<i class="feather icon-delete"></i> @lang('form.remove')</a></td>
                                                    </tr>
                                                    @empty
                                                   
                                                    @endforelse
                                                    @for ($i = $appfavcount; $i < 4; $i++)
                                                        <tr>
                                                            <td>{{$i+1}}</td>
                                                            <td>None</td>
                                                            <td>None</td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>