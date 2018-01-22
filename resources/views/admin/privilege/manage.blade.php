@extends('layouts.admin')

@section('style')
<style>
.ivu-card-head {
    background-color: #fbfbfb;
}
</style>
@endsection

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>角色权限管理</Breadcrumb-item>
    <Breadcrumb-item>角色权限配置</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

<form action="{{ url()->current() }}" method="post" ref="dataForm">
    {{ csrf_field() }}
    <input type="hidden" name="uid" :value="this.selected_uid">
    <input type="hidden" name="userPrivilegeIds" :value="JSON.stringify(this.userPrivilegeIds)">
    <input type="hidden" name="changedUserPrivilegeIds" :value="JSON.stringify(this.changedUserPrivilegeIds)">
</form>

<Row>
    <i-col span="6">
        <i-form :label-width="100">
            <Form-item label="选择用户：">
                <i-select v-model="selected_uid" @on-change="handleUidChanged">
                    @foreach ($users as $user)
                        <i-option value="{{ $user->id }}">{{ $user->username }}</i-option>
                    @endforeach
                </i-select>
            </Form-item>
        </i-form>
    </i-col>
    <i-col span="4">
        <i-button type="success" style="margin-left: 25px;" @click="clickSubmitBtn">保存提交</i-button>
    </i-col>
    <i-col offset="10" span="4">
        <i-button type="warning" Icon="grid" @click="toggleAllCollapsed">折叠/展开所有</i-button>
    </i-col>
</Row>

<Row>
    <i-col span="8" v-for="privilege_group in privilege_groups" :key="privilege_group.group_id">
        <div style="padding: 10px;">
            <Card dis-hover>
                <p slot="title">
                    <Checkbox
                    v-model="privilege_group.checked"
                    @on-change="handleCheckAllChanged($event, privilege_group)"
                    >&nbsp;@{{ privilege_group.group_title }}</Checkbox>
                </p>
                <span slot="extra">
                    <i-button Icon="plus" size="small" @click="privilege_group.collapsed=!privilege_group.collapsed" v-show="privilege_group.collapsed"></i-button>
                    <i-button Icon="minus" size="small" @click="privilege_group.collapsed=!privilege_group.collapsed" v-show="!privilege_group.collapsed"></i-button>
                </span>
                <div style="height: 150px; overflow-y: auto;" v-show="! privilege_group.collapsed">
                    <ul>
                        <li v-for="privilege in privilege_group.privileges" :key="privilege.id" style="display:inline-block;min-width:30%;padding:0 20px 15px 0;">
                            <Checkbox
                            v-model="privilege.checked"
                            @on-change="handleCheckChanged($event, privilege.id)"
                            >&nbsp;@{{ privilege.title }}</Checkbox>
                        </li>
                    </ul>
                </div>
                <p v-show="privilege_group.collapsed">已隐藏，点击右上角按钮展开......<b></b><p>

            </Card>
        </div>
    </i-col>
</Row>

@endsection

@section('script')
<script>
var vm = new Vue({
    el: '#app',
    data: {
        userPrivilegeIds: [
            @foreach ($userPrivilegeIds as $privilegeId)
                {{ $privilegeId }}
                @if (!$loop->last)
                ,
                @endif
            @endforeach
        ],
        changedUserPrivilegeIds: [
            @foreach ($userPrivilegeIds as $privilegeId)
                {{ $privilegeId }}
                @if (!$loop->last)
                ,
                @endif
            @endforeach
        ],
        selected_uid: '{{ $uid }}',
        allCollapsed: false,
        privilege_groups: [
            @foreach ($privilegeGroups as $privilegeGroup)
                {
                    group_id: {{ $privilegeGroup->id }},
                    group_title: '{{ $privilegeGroup->title }}',
                    checked: false,
                    collapsed: false,
                    privileges: [
                        @foreach ($privilegeGroup->privileges as $privilege)
                            {
                                id: {{ $privilege->id }},
                                title: '{{ $privilege->title }}',
                                checked: {{ in_array($privilege->id, $userPrivilegeIds) ? 'true' : 'false' }}
                            }
                            @if (! $loop->last)
                            ,
                            @endif
                        @endforeach
                    ]
                }
                @if (! $loop->last)
                ,
                @endif
            @endforeach
        ]
    },
    methods: {
        handleUidChanged: function (uid) {
            var url = '{{ url()->current() }}?uid=' + uid;
            window.location.href = url;
        },
        handleCheckAllChanged: function (event, item) {
            var privileges = item.privileges;
            for (var k in privileges) {
                if (privileges.hasOwnProperty(k)) {
                    privileges[k].checked = event;
                    this.handleCheckChanged(event, privileges[k].id);
                }
            }

        },
        handleCheckChanged: function (event, privilege_id) {
            var changedUserPrivilegeIds = this.changedUserPrivilegeIds;

            if (event) {
                var in_arr = false;
                for (var i = 0; i < changedUserPrivilegeIds.length; i++) {
                    if (changedUserPrivilegeIds[i] == privilege_id) {
                        in_arr = true;
                        break;
                    }
                }

                if (! in_arr) {
                    changedUserPrivilegeIds.push(privilege_id);
                }
            } else {
                for (var i = 0; i < changedUserPrivilegeIds.length; i++) {
                    if (changedUserPrivilegeIds[i] == privilege_id) {
                        changedUserPrivilegeIds.splice(i ,1);
                    }
                }
            }
        },
        toggleAllCollapsed: function () {
            this.allCollapsed = ! this.allCollapsed;
            var groups = this.privilege_groups;
            for (var k in groups) {
                if (groups.hasOwnProperty(k)) {
                    groups[k].collapsed = this.allCollapsed;
                }
            }
        },
        clickSubmitBtn: function () {
            if (this.selected_uid > 0) {
                this.$refs.dataForm.submit();
            }
        }
    }
});
</script>
@endsection
