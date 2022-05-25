<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
  public $dumy = "Dear Sir/Madam,<br>
		<br>
		<b><font color='red'>This is Dumy mail template content</font></b>,
		We are SiATEX, a design-to-delivery garments exporter from Bangladesh with manufacturing capabilities of both basic &amp; decorated knit and woven garments as per buyers’ requirement of designs and <br>specifications. We also can replicate any sorts of design from physical samples. In case you have <br>any inquiries, please send us an email with details for our quote and development.<br>
		<br>
		Our factories are ethically and socially audited to meet all your requirements.<br>
		<br>
		Hoping to get some inquiries from you soon.<br>
		<br>
		Thanks and best regards,<br>
		<br>
		For SiATEX (BD) Limited<br>
		Pranub Dutta<br>
		<br>
		—<br>
		SiATEX (BD) Limited<br>
		House – 8, Road – 6<br>
		Suite A5 &amp; B5, 5th Floor<br>
		Niketon, Gulshan – 1<br>
		Dhaka 1212, Bangladesh<br>
		<br>
		Ph: 0088 096 0422 3300 Ext 201<br>
		iNet: <a href=\"https://www.siatex.com\" target=\"_blank\">https://www.siatex.com</a>
		";
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $module = [
      "title" => "Template",
      "addRoute" => route("template.create"),
      "ajaxAdd" => false,
    ];
    return view("template")->with(["module" => $module]);
  }

  public function data()
  {
    return Template::paginate(10);
  }

  /**
   * Show the form for creating a new resource and Update existing.
   * @param Template ID
   * @return \Illuminate\Http\Response
   */
  public function create($id = false)
  {
    //
    if ($id) {
      $data = Template::find($id);
    } else {
      $data = new Template();
    }

    return view("template-create")->with([
      "module" => ["title" => "New Template"],
      "data" => $data,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rowData = $request->fData;
    $params = [];
    parse_str($rowData, $params);
    $templateData = $params["data"];
    //template_style
    $templateStyle = json_encode($params["style"]);
    $templateData["template_style"] = $templateStyle; //Json Encoded Styles
    if (isset($params["update"]) && !empty($params["update"])) {
      //Updated Area
      $id = trim($params["update"]);
      $template = Template::find($id);
      if ($template->update($templateData)) {
        return [
          "error" => false,
          "msg" => "Template Information has been Updated",
          "preview" => str_replace("%%BODY%%",$this->dumy,$this->makeTemplate($template)),
        ];
      }
    } else {
      //Insert Area
      $template = new Template($templateData);
      $template->save();
      return ["error" => false, "msg" => "New Template has been  inserted","preview" => $this->makeTemplate($template)];
    }
  }

  /**
   * Delete Newsletter by ID
   * @param Template ID
   */
  function delete($id)
  {
    $newsletter = Template::find($id);
    return $newsletter->delete();
  }

  function makeTemplate($arg)
  {
    //var_dump($arg);

    $imgUrl = $arg->header_text;
    $styles = $arg->styles;
    $contBG = !empty($arg->styles->container_bg)
      ? $arg->styles->container_bg
      : "#ffffff";
    $hH = !empty($arg->styles->header_height)
      ? $arg->styles->header_height
      : "auto";
    $fH = empty($arg->styles->footer_height)
      ? "auto"
      : $arg->styles->footer_height;
    $html =
      "
		<!DOCTYPE html>
		<html>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>%%TITLE%%</title>
        <style>
        $arg->custom_style
        </style>
		</head>
		<body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
		
		<div class='emailBody' style='
		background:" .
      $styles->body_bg .
      ";  width:100%;
		margin:0;
		padding: 0px 0 0px 0;
		'>
		<div class='emailContainer' style='max-width:$styles->container_width !important;margin:auto;'>
		<table width='100%' style=\"
		-webkit-border-top-left-radius:0px !important;
		-webkit-border-top-right-radius:0px !important;
		border-top-left-radius:0px !important;
		border-top-right-radius:0px !important;
		border-bottom: 0px !important;
		font-family:$styles->fontFamily;
		font-size:$styles->font_size;
		vertical-align:middle;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align='center'>
		<tr>
			<td v-align='middle'>
				<div class='emailHeader' style='line-height:$styles->header_line_height%;height:" .
      $hH .
      ";background:$styles->header_bg;margin:auto;font-size:$styles->header_font_size;padding:$styles->headerPadding;color:$styles->header_color'>$imgUrl</div>
			</td>
		</tr>
		<tr>
			<td class='emailMsgBody' style=\"background-color: $contBG; padding:$styles->contentPadding;color:$styles->contColor;font-family:$styles->fontFamily;\"><p style=\"text-align: $styles->body_text_align;font-size:$styles->font_size;font-family:$styles->fontFamily;line-height:$styles->body_line_height%\">%%BODY%%</p></td>
		</tr>
		<tr>
			<td  v-align='middle'>
				<div class='emailFooter' style='width:$styles->footer_width;height:$fH;background:$styles->footer_bg'>
					<p style='line-height:$styles->footer_line_height%;padding:$styles->footerPadding;margin:0;text-align:$styles->footertext_align;color:$styles->footer_color;font-family:$styles->footerfontFamily;font-size:$styles->footer_font_size'>$arg->footer_text</p>
				</div>
			</td>
		</tr>
		</table>
        </div>
		</div>
		
		</body>
		</html>";
    return $html;
  }
}
