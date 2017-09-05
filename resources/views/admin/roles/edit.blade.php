@extends('tukecx-core::admin._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <div class="layout-1columns">
        <div class="column main">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon-layers font-dark"></i> 角色信息
                    </h3>
                </div>
                <div class="box-body">
                    {!! Form::open(['class' => 'js-validate-form', 'url' => route('admin::acl-roles.edit.post', ['id' => $object->id])]) !!}
                    <div class="form-group">
                        <label class="control-label">名称<span class="required"> * </span></label>
                        <input type="text"
                               name="name"
                               value="{{ $object->name or '' }}"
                               class="form-control"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alias<span class="required"> * </span></label>
                        <input type="text"
                               value="{{ $object->slug or '' }}"
                               disabled
                               class="form-control"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">相关权限<span class="required"> * </span></label>
                        <div class="scroller form-control height-auto" style="max-height: 400px;"
                             data-always-visible="1" data-rail-visible="1">
                            <div class="p10">
                                @foreach($permissions as $key => $row)
                                    <div class="checkbox-group">
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   {{ in_array($row->id, $checkedPermissions) || $superAdminRole ? 'checked' : '' }}
                                                   value="{{ $row->id or '' }}">
                                            {{ $row->name or '' }}
                                            <small><b>&nbsp;({{ $row->module or '' }})</b></small>
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-check"></i> 保存
                        </button>
                        <button class="btn btn-success" type="submit" name="_continue_edit"
                                value="1">
                            <i class="fa fa-check"></i> 保存继续
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @php do_action('meta_boxes', 'main', 'acl-roles.edit', (isset($object) ? $object : null)) @endphp
        </div>
    </div>
@endsection
