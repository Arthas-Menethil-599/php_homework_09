<?php


class Matrix
{
    protected $matrix = [];
    public function __construct(array $matrix = []) {
        $this->matrix = $matrix;
    }

    public function get() {
        return $this->matrix;
    }

    public function set(array $matrix = []) {
        $this->matrix = $matrix;
    }

    /**
     * should be '-' or '+'
     * @param $operator
     *aa
     *
     * @return Matrix
     */
    //Дабы избежать дублирования, объединил функции add и diff
    public function add_or_diff(Matrix $matrix, $operator) : Matrix {
        //Проверки на корректность данных
        if(count($matrix->matrix) != count($this->matrix)) {
            throw new Exception('Matrix sizes do not match');
        }

        for($item = 0; $item < count($matrix->matrix); $item++) {
            if(count($matrix->matrix[$item]) != count($this->matrix[$item])) {
                throw new Exception('Matrix sizes do not match');
            }
        }
        //Вычисление
        $result = $matrix->matrix;
        for($j = 0; $j < count($matrix->matrix); $j++){
            for ($i = 0; $i < count($this->matrix); $i++) {
                if($operator == '+') {
                    $result[$i][$j] = $matrix->matrix[$i][$j] + $this->matrix[$i][$j];
                }
                elseif($operator == '-') {
                    $result[$i][$j] = $matrix->matrix[$i][$j] - $this->matrix[$i][$j];
                }
                else {
                    throw new Exception('incorrect value in parameter $operator');
                }
            }
        }
        //Возврат
        return new Matrix($result);
    }

    //multiply function
    public function mult(Matrix $matrix) : Matrix {

        $matrix_count_1 = count($this->matrix);
        $matrix_cell_count_2 = count($matrix->matrix[0]);
        $matrix_count_2 = count($matrix->matrix);

        if(count($this->matrix[0])!=$matrix_count_2) {
            throw new Exception('Incompatible matrixes');
        }

        $result=array();

        for ($i=0; $i< $matrix_count_1; $i++){
            for($j=0;$j<$matrix_cell_count_2;$j++){
                $result[$i][$j]=0;
                for($k=0; $k<$matrix_count_2; $k++){
                    $result[$i][$j]+=$this->matrix[$i][$k] * $matrix->matrix[$k][$j];
                }
            }
        }

        return new Matrix($result);
    }
}