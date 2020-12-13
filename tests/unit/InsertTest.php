<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;


final class InsertTest extends TestCase
{

    protected $bQ = null;

    protected function setUp(): void
    {
        $this->bQ = new QueryBuilder\Insert();
    }

    public function testBuildInsertSimple(): void
    {
        $sql = $this->bQ->buildInsert('produtos',
            [
                'id' => 1,
                'nome' => "'aasasdasdas'",
                'preco' => 1.20
            ]

        )->txt();

        $this->assertEquals($sql
        , "INSERT INTO produtos (id, nome, preco) VALUES (1, 'aasasdasdas', 1.2);");
    }

    public function testBuildInsertMultiple(): void
    {
        $sql = $this->bQ->buildInsert('produtos',[
            [
                'id' => 1,
                'nome' => "'nome1'",
                'preco' => 1.20
            ],
            [
                'id' => 2,
                'nome' => "'nome2'",
                'preco' => 1.23
            ],
            [
                'id' => 3,
                'nome' => "'nome3'",
                'preco' => 0.99
            ]
        ])->txt();

        $this->assertEquals(
            $sql,
            "INSERT INTO produtos (id, nome, preco) VALUES (1, 'nome1', 1.2), (2, 'nome2', 1.23), (3, 'nome3', 0.99);"
        );
    }
}
