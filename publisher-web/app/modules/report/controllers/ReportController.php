<?php

namespace Publisher\Modules\Report\Controllers;

use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use Publisher\Common\Models\Bill\Bill;
use Publisher\Common\Models\Bill\BillDetail;
use Publisher\Common\Models\Bill\Conveyor;
use Publisher\Common\Models\Bill\Producer;
use Publisher\Common\Models\Bill\TimeinTimeout;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Report\Forms\ReportForm;


class ReportController extends DashboardControllerBase
{
    private $limit_of_page = 10;

    public function initialize()
    {
        parent::initialize();

    }

    public function indexAction()
    {
        $this->view->names = [
            [
                'label' => 'Báo cáo tổng hợp',
                'href' => '/report'
            ],
        ];
        $this->view->activemenu = [
            'exports',
            'export'
        ];

    }

    public function reportViaMonthAction()
    {
        $this->view->names = [
            [
                'label' => 'Báo cáo tổng hợp theo tháng',
                'href' => '/report'
            ],
        ];
        $this->view->activemenu = [
            'exports',
            'export_month'
        ];
        $form = new ReportForm();
        $form->viaMonth();
        if ($this->request->isPost()) {
            $month = $this->request->getPost('month');
            if ($month < 10) {
                if (strlen($month) == 2) {

                } else {
                    $month = '0' . $month;
                }
            }
            $year = $this->request->getPost('year');
            ob_get_clean();
            $this->view->disable();
            $template = APPLICATION_PATH . '/../data/excel-tpl/Bao-cao.xls';
            $excel = \PHPExcel_IOFactory::load($template);
            $excel->setActiveSheetIndex(0);
            $bills = Bill::find([
                'conditions' => 'name LIKE :name:',
                'bind' => [
                    'name' => '%' . $month . $year . '%'
                ]
            ]);
            $current_line = 2;
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(75);
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $count = 1;
            $total_6= 0;
            $total_7=0;
            $total_8=0;
            $total_9=0;
            $total_quantity=0;
            foreach ($bills as $bill) {
                $current_line++;
                $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $current_line, $count++);
                $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $current_line, $bill->getName());
                $bill_detail = BillDetail::findFirst([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill->getId()
                    ]
                ]);
                $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $current_line, $bill_detail->product->getCode());
                $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $current_line, $bill_detail->product->getName());
                $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $bill_detail->getQuantity());
                $total_quantity+=$bill_detail->getQuantity();
                $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $current_line, $bill->status->getName());

                $times = TimeinTimeout::find([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill->getId()
                    ],
                    'order' => 'parent_id ASC'
                ]);
                foreach ($times as $time) {
                    if ($time->getMajorId() == 1) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_6+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 2) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_7+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 3) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_8+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 4) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_9+=$time->getCountTime();
                    } else {

                    }
                }

            }
            $current_line+=1;
            $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $total_quantity);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($total_6 / 60) . ' phút ' . $total_6 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($total_7 / 60) . ' phút ' . $total_7 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($total_8 / 60) . ' phút ' . $total_8 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($total_9 / 60) . ' phút ' . $total_9 % 60 . ' giây');
            $transcriptStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]];
            $excel->getActiveSheet()->getStyle("A3:" . 'J' . $current_line)->applyFromArray($transcriptStyle);
            $fileName = 'Bao-cao-theo-thang-' . $month . $year . '.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            ob_end_clean();
            $objWriter->save('php://output');
        } else {

        }
        $this->view->form = $form;
    }

    public function reportViaProductAction()
    {
        $this->view->names = [
            [
                'label' => 'Báo cáo tổng hợp theo sản phẩm',
                'href' => '/report'
            ],
        ];
        $this->view->activemenu = [
            'exports',
            'export_product'
        ];
        $form = new ReportForm();
        $form->viaProduct();

        if ($this->request->isPost()) {
            $product_id = $this->request->getPost('product_id');
            ob_get_clean();

            $this->view->disable();
            $template = APPLICATION_PATH . '/../data/excel-tpl/Bao-cao.xls';
            $excel = \PHPExcel_IOFactory::load($template);
            $excel->setActiveSheetIndex(0);
            $query = Bill::query()
                ->columns("Publisher\Common\Models\Bill\Bill.*")
                ->innerJoin('Publisher\Common\Models\Bill\BillDetail', 'Publisher\Common\Models\Bill\BillDetail.bill_id=Publisher\Common\Models\Bill\Bill.id')
                ->innerJoin('Publisher\Common\Models\Bill\Product', 'Publisher\Common\Models\Bill\BillDetail.product_id=Publisher\Common\Models\Bill\Product.id')
                ->where('Publisher\Common\Models\Bill\Product.id=:product_id:')
                ->bind([
                    'product_id' => $product_id
                ]);
            $bills = $query->execute();
            $current_line = 2;
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(75);
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $count = 1;
            $total_6= 0;
            $total_7=0;
            $total_8=0;
            $total_9=0;
            $total_quantity=0;
            foreach ($bills as $bill) {
                $current_line++;
                $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $current_line, $count++);
                $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $current_line, $bill->getName());
                $bill_detail = BillDetail::findFirst([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill->getId()
                    ]
                ]);
                $product_name = $bill_detail->product->getCode();
                $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $current_line, $bill_detail->product->getCode());
                $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $current_line, $bill_detail->product->getName());
                $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $bill_detail->getQuantity());
                $total_quantity+=$bill_detail->getQuantity();
                $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $current_line, $bill->status->getName());

                $times = TimeinTimeout::find([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill->getId()
                    ],
                    'order' => 'parent_id ASC'
                ]);
                foreach ($times as $time) {
                    if ($time->getMajorId() == 1) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_6+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 2) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_7+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 3) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_8+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 4) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_9+=$time->getCountTime();
                    } else {

                    }
                }

            }
            $current_line+=1;
            $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $total_quantity);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($total_6 / 60) . ' phút ' . $total_6 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($total_7 / 60) . ' phút ' . $total_7 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($total_8 / 60) . ' phút ' . $total_8 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($total_9 / 60) . ' phút ' . $total_9 % 60 . ' giây');
            $transcriptStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]];
            $excel->getActiveSheet()->getStyle("A3:" . 'J' . $current_line)->applyFromArray($transcriptStyle);
            $fileName = 'Bao-cao-theo-san-pham-' . $product_name . '.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            ob_end_clean();
            $objWriter->save('php://output');
        } else {

        }
        $this->view->form = $form;
    }

    public function reportViaProductAndMonthAction()
    {
        $this->view->names = [
            [
                'label' => 'Báo cáo tổng hợp theo sản phẩm và tháng',
                'href' => '/report'
            ],
        ];
        $this->view->activemenu = [
            'exports',
            'export_product_month'
        ];
        $form = new ReportForm();
        $form->viaMonthProduct();

        if ($this->request->isPost()) {
            $product_id = $this->request->getPost('product_id');
            $month = $this->request->getPost('month');
            if ($month < 10) {
                if (strlen($month) == 2) {

                } else {
                    $month = '0' . $month;
                }
            }
            $year = $this->request->getPost('year');
            ob_get_clean();

            $this->view->disable();
            $template = APPLICATION_PATH . '/../data/excel-tpl/Bao-cao.xls';
            $excel = \PHPExcel_IOFactory::load($template);
            $excel->setActiveSheetIndex(0);
            $query = Bill::query()
                ->columns("Publisher\Common\Models\Bill\Bill.*")
                ->innerJoin('Publisher\Common\Models\Bill\BillDetail', 'Publisher\Common\Models\Bill\BillDetail.bill_id=Publisher\Common\Models\Bill\Bill.id')
                ->innerJoin('Publisher\Common\Models\Bill\Product', 'Publisher\Common\Models\Bill\BillDetail.product_id=Publisher\Common\Models\Bill\Product.id')
                ->where('Publisher\Common\Models\Bill\Product.id=:product_id:')
                ->andWhere('Publisher\Common\Models\Bill\Bill.name LIKE :name:')
                ->bind([
                    'product_id' => $product_id,
                    'name' => '%' . $month . $year . '%'
                ]);
            $bills = $query->execute();
            $current_line = 2;
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(75);
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $count = 1;
            $total_6= 0;
            $total_7=0;
            $total_8=0;
            $total_9=0;
            $total_quantity=0;
            foreach ($bills as $bill) {
                $current_line++;
                $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $current_line, $count++);
                $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $current_line, $bill->getName());
                $bill_detail = BillDetail::findFirst([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill->getId()
                    ]
                ]);
                $product_name = $bill_detail->product->getCode();
                $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $current_line, $bill_detail->product->getCode());
                $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $current_line, $bill_detail->product->getName());
                $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $bill_detail->getQuantity());
                $total_quantity+=$bill_detail->getQuantity();
                $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $current_line, $bill->status->getName());

                $times = TimeinTimeout::find([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill->getId()
                    ],
                    'order' => 'parent_id ASC'
                ]);
                foreach ($times as $time) {
                    if ($time->getMajorId() == 1) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_6+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 2) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_7+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 3) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_8+=$time->getCountTime();
                    } elseif ($time->getMajorId() == 4) {
                        $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                        $total_9+=$time->getCountTime();
                    } else {

                    }
                }

            }
            $current_line+=1;
            $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $total_quantity);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($total_6 / 60) . ' phút ' . $total_6 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($total_7 / 60) . ' phút ' . $total_7 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($total_8 / 60) . ' phút ' . $total_8 % 60 . ' giây');
            $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($total_9 / 60) . ' phút ' . $total_9 % 60 . ' giây');
            $transcriptStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]];
            $excel->getActiveSheet()->getStyle("A3:" . 'J' . $current_line)->applyFromArray($transcriptStyle);
            $fileName = 'Bao-cao-theo-san-pham-' . $product_name . '.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            ob_end_clean();
            $objWriter->save('php://output');
        } else {

        }
        $this->view->form = $form;
    }

    public function exportReportAction()
    {
        ob_get_clean();

        $this->view->disable();
        $template = APPLICATION_PATH . '/../data/excel-tpl/Bao-cao.xls';
        $excel = \PHPExcel_IOFactory::load($template);
        $excel->setActiveSheetIndex(0);
        $bills = Bill::find([
            'order' => 'id ASC'
        ]);
        $current_line = 2;
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(75);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $count = 1;
        $total_6= 0;
        $total_7=0;
        $total_8=0;
        $total_9=0;
        $total_quantity=0;
        foreach ($bills as $bill) {
            $current_line++;
            $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $current_line, $count++);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $current_line, $bill->getName());
            $bill_detail = BillDetail::findFirst([
                'conditions' => 'bill_id=:bill_id:',
                'bind' => [
                    'bill_id' => $bill->getId()
                ]
            ]);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $current_line, $bill_detail->product->getCode());
            $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $current_line, $bill_detail->product->getName());
            $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $bill_detail->getQuantity());
            $total_quantity+=$bill_detail->getQuantity();
            $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $current_line, $bill->status->getName());

            $times = TimeinTimeout::find(['conditions' => 'bill_id=:bill_id:', 'bind' => ['bill_id' => $bill->getId()], 'order' => 'parent_id ASC']);
            foreach ($times as $time) {
                if ($time->getMajorId() == 1) {
                    $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                    $total_6+=$time->getCountTime();
                } elseif ($time->getMajorId() == 2) {
                    $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                    $total_7+=$time->getCountTime();
                } elseif ($time->getMajorId() == 3) {
                    $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                    $total_8+=$time->getCountTime();
                } elseif ($time->getMajorId() == 4) {
                    $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($time->getCountTime() / 60) . ' phút ' . $time->getCountTime() % 60 . ' giây');
                    $total_9+=$time->getCountTime();
                } else {

                }
            }

        }
        $current_line+=1;
        $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $current_line, $total_quantity);
        $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $current_line, floor($total_6 / 60) . ' phút ' . $total_6 % 60 . ' giây');
        $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $current_line, floor($total_7 / 60) . ' phút ' . $total_7 % 60 . ' giây');
        $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $current_line, floor($total_8 / 60) . ' phút ' . $total_8 % 60 . ' giây');
        $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $current_line, floor($total_9 / 60) . ' phút ' . $total_9 % 60 . ' giây');

        $transcriptStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]];
        $excel->getActiveSheet()->getStyle("A3:" . 'J' . $current_line)->applyFromArray($transcriptStyle);
        $fileName = 'Bao-cao-tong-hop.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }
}

