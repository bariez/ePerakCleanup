<?php

namespace Workbench\Site\Http\Controllers;

use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Carbon\Carbon;
use Curl;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Workbench\Site\Model\CmsMenu;
use Workbench\Site\Model\CmsWidget;
use Workbench\Site\Model\LkpAuditTrial;
use Workbench\Site\Model\PageColumn;
use Workbench\Site\Model\PageRow;
use Workbench\Site\Model\Pages;
use Workbench\Site\Model\Users;

class PageController extends Controller
{
    public function index()
    {
        $data = Pages::with('menu')->get();

        return view('site::system.page.index', compact('data'));
    }

    public function add(Request $request)
    {
        $request->name;

        $newpage = new Pages;
        $newpage->name = $request->name;
        $newpage->save();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Adding new page';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('Page created. Please edit your page to customize it');
    }

    public function edit($id)
    {
        // $segment = CmsMenu::label()->with('child','child.page','child.submenu','child.submenu.page')->get();
        // dd($segment);
        $page = Pages::where('id', '=', $id)->with('menu')->first();
        $pagerow = PageRow::where('fk_cms_page', '=', $id)->with('column')->get();
        $menu = CmsMenu::aclabel()->with('acchild', 'acchild.acsubmenu')->get();
        $widget = CmsWidget::active()->get();

        return view('site::system.page.edit', compact('page', 'pagerow', 'menu', 'widget'));
    }

    public function addrow($id)
    {
        $newrow = new PageRow;
        $newrow->fk_cms_page = $id;
        $newrow->save();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Adding new row';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('New Row Added');
    }

    public function removerow($id)
    {
        $removecolumn = PageColumn::where('fk_cms_page_row', '=', $id)->delete();
        $removerow = PageRow::where('id', '=', $id)->delete();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Deleting row';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('Row Deleted');
    }

    public function addcolumn($id)
    {
        $newcolumn = new PageColumn;
        $newcolumn->fk_cms_page_row = $id;
        $newcolumn->save();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Adding new column';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('New Column Added');
    }

    public function removecolumn($id)
    {
        $removecolumn = PageColumn::where('id', '=', $id)->delete();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Deleting column';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('Column Deleted');
    }

    public function update(Request $request)
    {
        $update = Pages::where('id', '=', $request->page_id)->first();
        $update->name = $request->name;
        $update->fk_cms_menu = $request->menu;
        $update->status = $request->status;
        $update->update();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Editing page';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('page Info successfully updated');
    }

    public function updatecolumn(Request $request)
    {

        // dd($request);
        $update = PageColumn::where('id', '=', $request->column_id)->first();
        $update->fk_cms_widget = $request->wid;
        $update->update();

        $userid = auth()->user()->name;
        $main_app = 'Page';
        $desc = 'Editing column';

        $this->auditTrail($userid, $main_app, $desc);

        return redirect()->back()->withSuccess('row is updated');
    }

    public function view(Request $request)
    {
        // dd($request);
        $page = Pages::where('id', '=', $request->id)->with('menu')->first();
        $pagerow = PageRow::where('fk_cms_page', '=', $request->id)->with('column', 'column.widget')->get();
        $id = $request->id;

        return view('site::page.view', compact('page', 'pagerow', 'id'));
    }

    public function auditTrail($userid = null, $main_app = null, $desc = null)
    {
        $data = new LkpAuditTrial;
        $data->user_id = $userid;
        $data->main_app = $main_app;
        $data->description = $desc;
        $data->save();
    }
}
