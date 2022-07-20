<?php
namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Manager\LinkManager;
use App\Manager\MaterialManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * CLass MaterialController
 *
 * @package App\Controller\MaterialController
 */
class MaterialController extends AbstractController
{
    /**
     * @param MaterialManager $materialManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function find(MaterialManager $materialManager)
    {
        $materials = $materialManager->findAllMaterials();
        return $this->render('material/index.html.twig', [
            'materials' => $materials
        ]);
    }

    /**
     * @param Request         $request
     * @param MaterialManager $materialManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, MaterialManager $materialManager)
    {
        $form = $this->createForm(MaterialType::class);
        $form->handleRequest($request);
        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $materialManager->creatMaterial($form->getData());
            $this->addFlash('success', 'materiel successfully created');
            return $this->redirectToRoute('app_material_index');
        }
        return $this->render(
            'material/create.html.twig',
            [
                'title' => 'Create a new Iframe',
                'subtitle' => '',
                'myform' => $form->createView(),
                'errors' => ''
            ]
        );
    }

    /**
     * @param Request         $request
     * @param MaterialManager $materialManager
     * @param Material        $material
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, MaterialManager $materialManager, Material $material)
    {
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materialManager->updateMaterial($form->getData());
            $this->addFlash('success', 'material successfully updated');
            return $this->redirectToRoute('app_material_index');
        }

        return $this->render(
            'material/create.html.twig',
            [
                'title' => 'Create a new Iframe',
                'subtitle' => '',
                'myform' => $form->createView(),
                'material' =>  $material,
                'errors' => ''
            ]
        );
    }

    /**
     * @param MaterialManager $materialManager
     * @param LinkManager     $linkManager
     * @param Material        $material
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function disabled(MaterialManager $materialManager,
                             LinkManager $linkManager,
                             Material $material)
    {
        $linkManager->disabledLinkByArgument($material->getId(), 'material');
        $materialManager->disabledMaterial($material);
        $this->addFlash('success', 'customer successfully disabled');
        return $this->redirectToRoute('app_material_index');
    }
}
